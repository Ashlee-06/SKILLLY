<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ChatSession;
use App\Models\Skill;
use App\Models\CareerDomain;

class AdminController extends Controller
{
    // ── Dashboard ────────────────────────────────────────────────
    public function dashboard()
    {
        $stats = [
            'users'         => User::where('is_admin', false)->count(),
            'analyses'      => ChatSession::count(),
            'skills'        => Skill::count(),
            'careers'       => CareerDomain::count(),
            'today'         => ChatSession::whereDate('created_at', today())->count(),
            'this_week'     => ChatSession::where('created_at', '>=', now()->startOfWeek())->count(),
        ];

        $recentAnalyses = ChatSession::with('user')
            ->latest()
            ->take(8)
            ->get();

        $topCareers = ChatSession::selectRaw('career, count(*) as total')
            ->groupBy('career')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentAnalyses', 'topCareers'));
    }

    // ── Users list ───────────────────────────────────────────────
    public function users()
    {
        $users = User::where('is_admin', false)
            ->withCount('chatSessions')
            ->latest()
            ->paginate(20);

        return view('admin.users', compact('users'));
    }

    // ── View one user's analyses ─────────────────────────────────
    public function userAnalyses(User $user)
    {
        $analyses = ChatSession::where('user_id', $user->id)
            ->latest()
            ->paginate(15);

        return view('admin.user_analyses', compact('user', 'analyses'));
    }

    // ── All analyses ─────────────────────────────────────────────
    public function analyses()
    {
        $analyses = ChatSession::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.analyses', compact('analyses'));
    }

    // ── Delete a user ────────────────────────────────────────────
    public function deleteUser(User $user)
    {
        if ($user->is_admin) {
            return back()->withErrors('Cannot delete an admin account.');
        }
        $user->delete();
        return back()->with('success', "User {$user->email} deleted successfully.");
    }

    // ── Delete an analysis ───────────────────────────────────────
    public function deleteAnalysis(ChatSession $analysis)
    {
        $analysis->delete();
        return back()->with('success', 'Analysis deleted.');
    }
}