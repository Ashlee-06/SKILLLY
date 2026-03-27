@extends('admin.layout')
@section('title', $skill ? 'Edit Skill' : 'Add Skill')
@section('page-title', $skill ? 'Edit Skill' : 'Add Skill')

@section('content')

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.skills.index') }}" class="btn-admin btn-outline-admin">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div>
        <h5 class="fw-bold mb-0">{{ $skill ? 'Edit: ' . $skill->skill_name : 'Add New Skill' }}</h5>
        <p style="color:var(--muted); font-size:0.83rem; margin:0;">{{ $skill ? 'Update skill details and matching keywords' : 'Define a new skill for the extraction engine' }}</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="admin-card">
            <form method="POST" action="{{ $skill ? route('admin.skills.update', $skill) : route('admin.skills.store') }}">
                @csrf
                @if($skill) @method('PUT') @endif

                <div class="mb-3">
                    <label class="form-label-admin">Skill Name <span style="color:#fca5a5;">*</span></label>
                    <input type="text" name="skill_name" class="form-input-admin"
                        value="{{ old('skill_name', $skill?->skill_name) }}"
                        placeholder="e.g. Machine Learning"
                        required>
                    @error('skill_name')<div style="color:#fca5a5; font-size:0.78rem; margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label-admin">Skill Type <span style="color:#fca5a5;">*</span></label>
                    <select name="skill_type" class="form-input-admin" required>
                        <option value="">Select type...</option>
                        <option value="technical" {{ old('skill_type', $skill?->skill_type) === 'technical' ? 'selected' : '' }}>Technical</option>
                        <option value="soft"      {{ old('skill_type', $skill?->skill_type) === 'soft'      ? 'selected' : '' }}>Soft</option>
                    </select>
                    @error('skill_type')<div style="color:#fca5a5; font-size:0.78rem; margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label class="form-label-admin">Keywords <span style="color:#fca5a5;">*</span></label>
                    <textarea name="keywords" class="form-input-admin" rows="4"
                        placeholder="Comma-separated keywords — e.g. machine learning, ml, deep learning, neural networks"
                        required>{{ old('keywords', $skill?->keywords) }}</textarea>
                    <div style="font-size:0.78rem; color:var(--muted); margin-top:5px;">
                        Enter all keyword variations separated by commas. The extraction engine will match any of these against the resume text.
                    </div>
                    @error('keywords')<div style="color:#fca5a5; font-size:0.78rem; margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn-admin btn-primary-admin">
                        <i class="fa-solid fa-{{ $skill ? 'floppy-disk' : 'plus' }}"></i>
                        {{ $skill ? 'Save Changes' : 'Create Skill' }}
                    </button>
                    <a href="{{ route('admin.skills.index') }}" class="btn-admin btn-outline-admin">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="admin-card">
            <h6 class="fw-bold mb-3">Tips for keywords</h6>
            <div style="font-size:0.85rem; color:var(--muted); line-height:1.7;">
                <p class="mb-2">Keywords are matched case-insensitively against the resume text.</p>
                <p class="mb-2"><strong style="color:var(--text);">Include common variations</strong> — e.g. for JavaScript include: javascript, js, node.js, nodejs</p>
                <p class="mb-2"><strong style="color:var(--text);">For special characters</strong> like C++ or C#, include the full name too: c++, cplusplus</p>
                <p class="mb-2"><strong style="color:var(--text);">Separate with commas</strong> — spaces around commas are trimmed automatically</p>
                <p class="mb-0"><strong style="color:var(--text);">Shorter keywords first</strong> is not needed — the engine handles ordering automatically</p>
            </div>
        </div>
    </div>
</div>

@endsection