<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerDomain;
use App\Models\CareerSkillRule;
use App\Models\Skill;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $query = CareerDomain::withCount('rules');

        if ($request->filled('search')) {
            $query->where('career_name', 'like', '%' . $request->search . '%');
        }

        $careers = $query->orderBy('career_name')->paginate(20)->withQueryString();

        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        $skills = Skill::orderBy('skill_name')->get();
        return view('admin.careers.form', ['career' => null, 'skills' => $skills, 'rules' => collect()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'career_name' => 'required|string|max:150|unique:career_domains,career_name',
            'description' => 'nullable|string|max:500',
            'skills'      => 'nullable|array',
            'skills.*.skill_id' => 'required|exists:skills,id',
            'skills.*.weight'   => 'required|integer|min:1|max:10',
            // is_mandatory intentionally not validated — checkboxes send "on" not true/false
        ]);

        $career = CareerDomain::create([
            'career_name' => $data['career_name'],
            'description' => $data['description'] ?? null,
        ]);

        foreach (($request->input('skills', [])) as $rule) {
            CareerSkillRule::create([
                'career_domain_id' => $career->id,
                'skill_id'         => $rule['skill_id'],
                'is_mandatory'     => !empty($rule['is_mandatory']),
                'weight'           => (int) $rule['weight'],
            ]);
        }

        return redirect()->route('admin.careers.index')
            ->with('success', "Career \"{$career->career_name}\" created successfully.");
    }

    public function edit(CareerDomain $career)
    {
        $skills = Skill::orderBy('skill_name')->get();
        $rules  = CareerSkillRule::with('skill')->where('career_domain_id', $career->id)->get();
        return view('admin.careers.form', compact('career', 'skills', 'rules'));
    }

    public function update(Request $request, CareerDomain $career)
    {
        $data = $request->validate([
            'career_name' => 'required|string|max:150|unique:career_domains,career_name,' . $career->id,
            'description' => 'nullable|string|max:500',
            'skills'      => 'nullable|array',
            'skills.*.skill_id' => 'required|exists:skills,id',
            'skills.*.weight'   => 'required|integer|min:1|max:10',
        ]);

        $career->update([
            'career_name' => $data['career_name'],
            'description' => $data['description'] ?? null,
        ]);

        CareerSkillRule::where('career_domain_id', $career->id)->delete();

        foreach (($request->input('skills', [])) as $rule) {
            CareerSkillRule::create([
                'career_domain_id' => $career->id,
                'skill_id'         => $rule['skill_id'],
                'is_mandatory'     => !empty($rule['is_mandatory']),
                'weight'           => (int) $rule['weight'],
            ]);
        }

        return redirect()->route('admin.careers.index')
            ->with('success', "Career \"{$career->career_name}\" updated.");
    }

    public function destroy(CareerDomain $career)
    {
        $name = $career->career_name;
        $career->delete();
        return back()->with('success', "Career \"{$name}\" deleted.");
    }
}