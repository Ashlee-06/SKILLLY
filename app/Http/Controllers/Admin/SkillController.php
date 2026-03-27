<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(Request $request)
    {
        $query = Skill::query();

        if ($request->filled('search')) {
            $query->where('skill_name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('type')) {
            $query->where('skill_type', $request->type);
        }

        $skills = $query->orderBy('skill_name')->paginate(25)->withQueryString();

        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.form', ['skill' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'skill_name' => 'required|string|max:100|unique:skills,skill_name',
            'skill_type' => 'required|in:technical,soft',
            'keywords'   => 'required|string|max:1000',
        ]);

        Skill::create($data);

        return redirect()->route('admin.skills.index')
            ->with('success', "Skill \"{$data['skill_name']}\" created successfully.");
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.form', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $data = $request->validate([
            'skill_name' => 'required|string|max:100|unique:skills,skill_name,' . $skill->id,
            'skill_type' => 'required|in:technical,soft',
            'keywords'   => 'required|string|max:1000',
        ]);

        $skill->update($data);

        return redirect()->route('admin.skills.index')
            ->with('success', "Skill \"{$skill->skill_name}\" updated.");
    }

    public function destroy(Skill $skill)
    {
        $name = $skill->skill_name;
        $skill->delete();
        return back()->with('success', "Skill \"{$name}\" deleted.");
    }
}