<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Skillly Career Report</title>
    <style>

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DejaVu Sans', 'Helvetica Neue', 'Arial', sans-serif;
            background: #ffffff;
            color: #1e293b;
            font-size: 12px;
            line-height: 1.6;
        }

        .page {
            width: 100%;
            max-width: 720px;
            margin: 0 auto;
        }

        /* ── Header ─────────────────────────────────────────── */
        .header {
            background: #4f46e5;
            padding: 0;
        }
        .header-top {
            padding: 28px 40px 20px;
            display: table;
            width: 100%;
        }
        .brand-cell {
            display: table-cell;
            vertical-align: middle;
        }
        .brand-name {
            font-size: 22px;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: -0.5px;
        }
        .brand-name span {
            display: inline-block;
            width: 8px;
            height: 8px;
            background: #a5b4fc;
            border-radius: 50%;
            margin-left: 2px;
            vertical-align: middle;
        }
        .brand-sub {
            font-size: 9px;
            color: rgba(255,255,255,0.55);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 2px;
        }
        .meta-cell {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            font-size: 9.5px;
            color: rgba(255,255,255,0.55);
            line-height: 1.7;
        }

        /* ── Career hero strip ───────────────────────────────── */
        .career-hero {
            background: rgba(255,255,255,0.1);
            border-top: 1px solid rgba(255,255,255,0.15);
            padding: 22px 40px;
            display: table;
            width: 100%;
        }
        .career-hero-left {
            display: table-cell;
            vertical-align: middle;
        }
        .career-label {
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(255,255,255,0.5);
            margin-bottom: 5px;
        }
        .career-title {
            font-size: 26px;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: -0.5px;
            line-height: 1.15;
        }
        .career-subtitle {
            font-size: 10.5px;
            color: rgba(255,255,255,0.6);
            margin-top: 5px;
        }
        .career-hero-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 140px;
        }
        .score-circle {
            display: inline-block;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.12);
            border: 3px solid rgba(255,255,255,0.3);
            text-align: center;
            padding-top: 16px;
        }
        .score-num {
            font-size: 24px;
            font-weight: 900;
            color: #ffffff;
            line-height: 1;
        }
        .score-pct {
            font-size: 11px;
            font-weight: 700;
            color: rgba(255,255,255,0.7);
        }
        .score-word {
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.5);
            margin-top: 2px;
        }

        /* ── Progress bar strip ──────────────────────────────── */
        .progress-strip {
            background: #3730a3;
            padding: 14px 40px;
            display: table;
            width: 100%;
        }
        .progress-label-cell {
            display: table-cell;
            vertical-align: middle;
            width: 120px;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.55);
        }
        .progress-bar-cell {
            display: table-cell;
            vertical-align: middle;
        }
        .progress-track {
            background: rgba(255,255,255,0.15);
            border-radius: 99px;
            height: 6px;
            width: 100%;
        }
        .progress-fill {
            background: #a5b4fc;
            height: 6px;
            border-radius: 99px;
        }
        .progress-comment-cell {
            display: table-cell;
            vertical-align: middle;
            width: 200px;
            text-align: right;
            font-size: 9.5px;
            color: rgba(255,255,255,0.6);
            padding-left: 16px;
            font-style: italic;
        }

        /* ── Body ────────────────────────────────────────────── */
        .body { padding: 32px 40px; }

        /* ── Section titles ──────────────────────────────────── */
        .section { margin-bottom: 26px; }
        .section-title {
            font-size: 8.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #4f46e5;
            margin-bottom: 12px;
            padding-bottom: 7px;
            border-bottom: 2px solid #e0e7ff;
        }

        /* ── Two column ──────────────────────────────────────── */
        .two-col {
            display: table;
            width: 100%;
            border-spacing: 14px 0;
            border-collapse: separate;
            margin-left: -14px;
            width: calc(100% + 28px);
        }
        .col { display: table-cell; vertical-align: top; width: 50%; }

        /* ── Skill list ──────────────────────────────────────── */
        .skill-list {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
        }
        .skill-row {
            display: table;
            width: 100%;
            padding: 7px 14px;
            border-bottom: 1px solid #f1f5f9;
        }
        .skill-row:last-child { border-bottom: none; }
        .skill-row.alt { background: #ffffff; }
        .skill-dot-cell {
            display: table-cell;
            vertical-align: middle;
            width: 20px;
        }
        .dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            display: inline-block;
        }
        .dot-green  { background: #22c55e; }
        .dot-orange { background: #f97316; }
        .skill-name-cell {
            display: table-cell;
            vertical-align: middle;
            font-size: 11.5px;
            color: #334155;
            font-weight: 500;
            text-transform: capitalize;
        }
        .skill-empty {
            padding: 10px 14px;
            font-size: 11px;
            color: #94a3b8;
            font-style: italic;
        }

        /* ── Next steps ──────────────────────────────────────── */
        .step-row {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }
        .step-num-cell {
            display: table-cell;
            vertical-align: top;
            width: 30px;
        }
        .step-badge {
            width: 22px; height: 22px;
            border-radius: 6px;
            background: #4f46e5;
            color: #ffffff;
            font-size: 10px;
            font-weight: 800;
            text-align: center;
            line-height: 22px;
            display: inline-block;
        }
        .step-text-cell {
            display: table-cell;
            vertical-align: top;
            font-size: 11.5px;
            color: #475569;
            padding-top: 3px;
            line-height: 1.65;
        }
        .step-text-cell strong { color: #1e293b; }

        /* ── Alternative careers ─────────────────────────────── */
        .alt-career-row {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }
        .alt-career-name-cell {
            display: table-cell;
            vertical-align: middle;
            font-size: 11.5px;
            font-weight: 600;
            color: #334155;
        }
        .alt-career-pct-cell {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 50px;
            font-size: 11px;
            font-weight: 700;
            color: #4f46e5;
        }
        .alt-bar-cell {
            display: table-cell;
            vertical-align: middle;
            width: 120px;
            padding-left: 12px;
        }
        .alt-bar-track {
            background: #e0e7ff;
            border-radius: 99px;
            height: 5px;
        }
        .alt-bar-fill {
            background: #6366f1;
            height: 5px;
            border-radius: 99px;
        }
        .alt-career-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 6px 14px;
            margin-bottom: 6px;
        }
        .alt-career-card:last-child { margin-bottom: 0; }

        /* ── Divider ─────────────────────────────────────────── */
        .divider {
            border: none;
            border-top: 1px solid #f1f5f9;
            margin: 4px 0 16px;
        }

        /* ── Footer ──────────────────────────────────────────── */
        .footer {
            background: #f8fafc;
            border-top: 2px solid #e0e7ff;
            padding: 14px 40px;
            display: table;
            width: 100%;
        }
        .footer-left {
            display: table-cell;
            vertical-align: middle;
            font-size: 9px;
            color: #94a3b8;
        }
        .footer-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            font-size: 9px;
            color: #94a3b8;
        }
        .footer-brand { font-weight: 800; color: #4f46e5; }

        /* ── Info box ────────────────────────────────────────── */
        .info-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 11px;
            color: #1e40af;
            margin-bottom: 14px;
            line-height: 1.6;
        }

    </style>
</head>
<body>

<?php
    $careerName       = is_string($career) ? $career : ($career->career_name ?? 'Career Path Identified');
    $topPct           = session('topPercentage') ?? (count($matchedSkills) + count($missingSkills) > 0
                            ? round((count($matchedSkills) / (count($matchedSkills) + count($missingSkills))) * 100)
                            : 0);
    $allRecs          = session('allRecommendations', []);
    $alternativeCareers = array_filter($allRecs ?? [], fn($r) => $r['career'] !== $careerName);
    $alternativeCareers = array_slice(array_values($alternativeCareers), 0, 5);

    if ($topPct >= 80)      { $readinessComment = "You're in great shape — just a few finishing touches needed."; $readinessLabel = "Excellent"; }
    elseif ($topPct >= 60)  { $readinessComment = "Solid progress. Bridging a couple of gaps will make a real difference."; $readinessLabel = "Good"; }
    elseif ($topPct >= 40)  { $readinessComment = "Good foundation. Focus on the top missing skills as your next step."; $readinessLabel = "Developing"; }
    else                    { $readinessComment = "Room to grow — every expert started as a beginner. Keep building."; $readinessLabel = "Early Stage"; }
?>

<div class="page">

    {{-- ── Header ── --}}
    <div class="header">

        <div class="header-top">
            <div class="brand-cell">
                <div class="brand-name">Skillly<span></span></div>
                <div class="brand-sub">Career Guidance Report</div>
            </div>
            <div class="meta-cell">
                Generated: {{ now()->format('d M Y') }}<br>
                {{ now()->format('g:i A') }}
            </div>
        </div>

        <div class="career-hero">
            <div class="career-hero-left">
                <div class="career-label">Top Career Match</div>
                <div class="career-title">{{ $careerName }}</div>
                <div class="career-subtitle">Best match based on your extracted skills &amp; experience</div>
            </div>
            <div class="career-hero-right">
                <div class="score-circle">
                    <div class="score-num">{{ $topPct }}</div>
                    <div class="score-pct">%</div>
                    <div class="score-word">Match</div>
                </div>
            </div>
        </div>

        <div class="progress-strip">
            <div class="progress-label-cell">Match Score</div>
            <div class="progress-bar-cell">
                <div class="progress-track">
                    <div class="progress-fill" style="width: {{ $topPct }}%;"></div>
                </div>
            </div>
            <div class="progress-comment-cell">{{ $readinessComment }}</div>
        </div>

    </div>

    {{-- ── Body ── --}}
    <div class="body">

        {{-- ── Skills Two Column ── --}}
        <div class="two-col">

            {{-- Matched Skills --}}
            <div class="col">
                <div class="section">
                    <div class="section-title">Strong Skills &mdash; {{ count($matchedSkills) }} found</div>
                    <div class="skill-list">
                        @forelse($matchedSkills as $i => $skill)
                            <div class="skill-row {{ $i % 2 === 0 ? 'alt' : '' }}">
                                <div class="skill-dot-cell"><span class="dot dot-green"></span></div>
                                <div class="skill-name-cell">{{ ucwords($skill) }}</div>
                            </div>
                        @empty
                            <div class="skill-empty">No matched skills detected.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Missing Skills --}}
            <div class="col">
                <div class="section">
                    <div class="section-title">Skills to Develop &mdash; {{ count($missingSkills) }} identified</div>
                    <div class="skill-list">
                        @forelse($missingSkills as $i => $skill)
                            <div class="skill-row {{ $i % 2 === 0 ? 'alt' : '' }}">
                                <div class="skill-dot-cell"><span class="dot dot-orange"></span></div>
                                <div class="skill-name-cell">{{ ucwords($skill) }}</div>
                            </div>
                        @empty
                            <div class="skill-empty">No critical gaps detected. Great work!</div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

        {{-- ── Next Steps ── --}}
        <div class="section">
            <div class="section-title">Suggested Action Plan</div>
            @if(!empty($missingSkills))
                <div class="step-row">
                    <div class="step-num-cell"><div class="step-badge">1</div></div>
                    <div class="step-text-cell">
                        <strong>Start with {{ ucwords($missingSkills[0]) }}.</strong>
                        Build a small hands-on project or follow a structured tutorial. Document it on GitHub or your portfolio to demonstrate progress.
                    </div>
                </div>
                @if(isset($missingSkills[1]))
                <div class="step-row">
                    <div class="step-num-cell"><div class="step-badge">2</div></div>
                    <div class="step-text-cell">
                        <strong>Move on to {{ ucwords($missingSkills[1]) }}.</strong>
                        Once you have a working example of step 1, add this to your learning roadmap — even a learning project on your resume counts.
                    </div>
                </div>
                @endif
                <div class="step-row">
                    <div class="step-num-cell"><div class="step-badge">{{ isset($missingSkills[1]) ? 3 : 2 }}</div></div>
                    <div class="step-text-cell">
                        <strong>Update your resume.</strong>
                        Ensure your strongest skills — <strong>{{ collect($matchedSkills)->take(3)->map('ucwords')->implode(', ') }}</strong> — are clearly highlighted with specific examples and measurable results.
                    </div>
                </div>
                <div class="step-row">
                    <div class="step-num-cell"><div class="step-badge">{{ isset($missingSkills[1]) ? 4 : 3 }}</div></div>
                    <div class="step-text-cell">
                        <strong>Stay consistent.</strong>
                        30 minutes of focused practice daily beats 5-hour weekend sessions. Track your progress and re-analyse your resume as you grow.
                    </div>
                </div>
            @else
                <div class="step-row">
                    <div class="step-num-cell"><div class="step-badge">1</div></div>
                    <div class="step-text-cell">
                        <strong>Build real-world projects.</strong>
                        You're well-aligned with {{ $careerName }}. The best way to stand out is shipping projects that demonstrate your skills to employers.
                    </div>
                </div>
                <div class="step-row">
                    <div class="step-num-cell"><div class="step-badge">2</div></div>
                    <div class="step-text-cell">
                        <strong>Deepen your strongest skills.</strong>
                        Advanced mastery of {{ collect($matchedSkills)->take(2)->map('ucwords')->implode(' and ') }} will differentiate you from other candidates.
                    </div>
                </div>
                <div class="step-row">
                    <div class="step-num-cell"><div class="step-badge">3</div></div>
                    <div class="step-text-cell">
                        <strong>Contribute to open source.</strong>
                        Real contributions are powerful portfolio pieces that show employers you can work in collaborative, production-grade codebases.
                    </div>
                </div>
            @endif
        </div>

        {{-- ── Alternative Careers ── --}}
        @if(!empty($alternativeCareers))
        <div class="section">
            <div class="section-title">Other Career Paths That Matched Your Profile</div>
            <div class="info-box">
                Based on your skills, the following career paths also showed strong alignment.
                These could be great alternatives or complementary directions to explore.
            </div>
            @foreach($alternativeCareers as $alt)
                <div class="alt-career-card">
                    <div class="alt-career-row">
                        <div class="alt-career-name-cell">{{ $alt['career'] }}</div>
                        <div class="alt-bar-cell">
                            <div class="alt-bar-track">
                                <div class="alt-bar-fill" style="width: {{ min($alt['percentage'], 100) }}%;"></div>
                            </div>
                        </div>
                        <div class="alt-career-pct-cell">{{ $alt['percentage'] }}%</div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif

    </div>

    {{-- ── Footer ── --}}
    <div class="footer">
        <div class="footer-left">
            Confidential &mdash; Generated for personal career use only &mdash; Do not distribute
        </div>
        <div class="footer-right">
            Powered by <span class="footer-brand">Skillly</span> &bull; {{ now()->format('Y') }}
        </div>
    </div>

</div>
</body>
</html>