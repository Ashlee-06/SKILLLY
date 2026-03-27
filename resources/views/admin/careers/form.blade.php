@extends('admin.layout')
@section('title', $career ? 'Edit Career' : 'Add Career')
@section('page-title', $career ? 'Edit Career Domain' : 'Add Career Domain')

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
        {{-- Left: Career details --}}
        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <h6 class="fw-bold mb-3">Career Details</h6>

                <div class="mb-3">
                    <label class="form-label-admin">Career Name <span style="color:#fca5a5;">*</span></label>
                    <input type="text" name="career_name" class="form-input-admin"
                        value="{{ old('career_name', $career?->career_name) }}"
                        placeholder="e.g. Backend Developer" required>
                    @error('career_name')<div style="color:#fca5a5; font-size:0.78rem; margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label-admin">Description</label>
                    <textarea name="description" class="form-input-admin" rows="4"
                        placeholder="Brief one-sentence description of this role...">{{ old('description', $career?->description) }}</textarea>
                </div>

                <div style="background:rgba(99,102,241,0.08); border:1px solid rgba(99,102,241,0.2); border-radius:10px; padding:12px 14px; font-size:0.83rem; color:#a5b4fc; line-height:1.6;">
                    <strong>Weight guide:</strong><br>
                    5 = core mandatory skill<br>
                    3 = important skill<br>
                    1 = nice to have
                </div>
            </div>

            <button type="submit" class="btn-admin btn-primary-admin w-100" style="justify-content:center; padding:12px;">
                <i class="fa-solid fa-{{ $career ? 'floppy-disk' : 'plus' }}"></i>
                {{ $career ? 'Save Changes' : 'Create Career' }}
            </button>
        </div>

        {{-- Right: Skill rules --}}
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="fw-bold mb-0">Skill Rules</h6>
                    <button type="button" class="btn-admin btn-primary-admin" onclick="addRule()" style="padding:6px 14px; font-size:0.8rem;">
                        <i class="fa-solid fa-plus"></i> Add Skill
                    </button>
                </div>

                <div style="font-size:0.8rem; color:var(--muted); margin-bottom:12px;">
                    Add all skills required or recommended for this career. Tick Mandatory for core skills.
                </div>

                <div id="rules-container">
                    @if($rules->isNotEmpty())
                        @foreach($rules as $i => $rule)
                        <div class="rule-row" id="rule-{{ $loop->index }}">
                            <select name="skills[{{ $loop->index }}][skill_id]" required>
                                <option value="">Select skill...</option>
                                @foreach($skills as $skill)
                                <option value="{{ $skill->id }}" {{ $rule->skill_id == $skill->id ? 'selected' : '' }}>
                                    {{ $skill->skill_name }} ({{ $skill->skill_type }})
                                </option>
                                @endforeach
                            </select>
                            <div style="display:flex; align-items:center; gap:5px; white-space:nowrap;">
                                <label style="font-size:0.8rem; color:var(--muted);">Weight</label>
                                <input type="number" name="skills[{{ $loop->index }}][weight]" value="{{ $rule->weight }}" min="1" max="10" required>
                            </div>
                            <div style="display:flex; align-items:center; gap:6px; white-space:nowrap;">
                                <input type="checkbox" name="skills[{{ $loop->index }}][is_mandatory]" id="mandatory-{{ $loop->index }}" {{ $rule->is_mandatory ? 'checked' : '' }} style="accent-color:#6366f1; width:16px; height:16px;">
                                <label for="mandatory-{{ $loop->index }}" style="font-size:0.8rem; color:var(--muted); cursor:pointer;">Mandatory</label>
                            </div>
                            <button type="button" class="remove-rule" onclick="removeRule('rule-{{ $loop->index }}')">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        @endforeach
                    @else
                        <div id="empty-msg" style="text-align:center; padding:2rem; color:var(--muted); font-size:0.875rem;">
                            No skill rules yet. Click Add Skill to begin.
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
    const div = document.createElement('div');
    div.className = 'rule-row';
    div.id = `rule-${idx}`;

    const opts = allSkills.map(s =>
        `<option value="${s.id}">${s.name} (${s.type})</option>`
    ).join('');

    div.innerHTML = `
        <select name="skills[${idx}][skill_id]" required>
            <option value="">Select skill...</option>
            ${opts}
        </select>
        <div style="display:flex; align-items:center; gap:5px; white-space:nowrap;">
            <label style="font-size:0.8rem; color:var(--muted);">Weight</label>
            <input type="number" name="skills[${idx}][weight]" value="3" min="1" max="10" required>
        </div>
        <div style="display:flex; align-items:center; gap:6px; white-space:nowrap;">
            <input type="checkbox" name="skills[${idx}][is_mandatory]" id="mandatory-${idx}" style="accent-color:#6366f1; width:16px; height:16px;">
            <label for="mandatory-${idx}" style="font-size:0.8rem; color:var(--muted); cursor:pointer;">Mandatory</label>
        </div>
        <button type="button" class="remove-rule" onclick="removeRule('rule-${idx}')">
            <i class="fa-solid fa-xmark"></i>
        </button>
    `;
    container.appendChild(div);
}

function removeRule(id) {
    const el = document.getElementById(id);
    if (el) el.remove();
    if (document.getElementById('rules-container').children.length === 0) {
        document.getElementById('rules-container').innerHTML = `
            <div id="empty-msg" style="text-align:center; padding:2rem; color:var(--muted); font-size:0.875rem;">
                No skill rules yet. Click Add Skill to begin.
            </div>`;
    }
}
</script>
@endpush