<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ChatSession;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ─────────────────────────────────────────────────────────────
    // Dashboard — list all sessions for the logged-in user
    // ─────────────────────────────────────────────────────────────

    public function index()
    {
        $sessions = Auth::user()
            ->chatSessions()
            ->paginate(10);

        return view('history.index', compact('sessions'));
    }

    // ─────────────────────────────────────────────────────────────
    // Show a single past session
    // ─────────────────────────────────────────────────────────────

    public function show(ChatSession $chatSession)
    {
        // Ensure session belongs to the authenticated user
        abort_if($chatSession->user_id !== Auth::id(), 403);

        $conversation  = $chatSession->conversation;
        $career        = $chatSession->career;
        $matchedSkills = $chatSession->matched_skills;
        $missingSkills = $chatSession->missing_skills;

        return view('history.show', compact(
            'chatSession', 'conversation', 'career', 'matchedSkills', 'missingSkills'
        ));
    }

    // ─────────────────────────────────────────────────────────────
    // Download PDF report for a saved session
    // ─────────────────────────────────────────────────────────────

    public function downloadReport(ChatSession $chatSession)
    {
        abort_if($chatSession->user_id !== Auth::id(), 403);

        $career        = $chatSession->career;
        $matchedSkills = $chatSession->matched_skills;
        $missingSkills = $chatSession->missing_skills;
        $conversation  = $chatSession->conversation;

        try {
            $pdf = Pdf::loadView('resume.report', compact(
                'career', 'matchedSkills', 'missingSkills', 'conversation'
            ));
            $filename = 'skillly_report_' . $chatSession->id . '.pdf';
            return $pdf->download($filename);
        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('history.index')
                ->withErrors('We could not generate your report. Please try again.');
        }
    }

    // ─────────────────────────────────────────────────────────────
    // Delete a saved session
    // ─────────────────────────────────────────────────────────────

    public function destroy(ChatSession $chatSession)
    {
        abort_if($chatSession->user_id !== Auth::id(), 403);

        $chatSession->delete();

        return redirect()->route('history.index')
            ->with('success', 'Analysis deleted successfully.');
    }
}