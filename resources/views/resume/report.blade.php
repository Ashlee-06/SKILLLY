<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Skillly Career Report</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body {
    font-family: 'DejaVu Sans', Arial, sans-serif;
    background: #ffffff;
    color: #1e293b;
    font-size: 12px;
    line-height: 1.5;
}
.page { width: 100%; }

/* ── HEADER ── */
.header { background: #0f172a; padding: 24px 32px 0; }
.hdr-tbl { width: 100%; border-collapse: collapse; }
.hdr-brand-td { vertical-align: middle; }
.hdr-meta-td  { vertical-align: middle; text-align: right; }
.h-dot  { display: inline-block; width: 9px; height: 9px; background: #6366f1; border-radius: 50%; vertical-align: middle; margin-right: 6px; }
.h-name { font-size: 20px; font-weight: 900; color: #ffffff; letter-spacing: -0.5px; vertical-align: middle; }
.h-tag  { font-size: 8px; color: #475569; letter-spacing: 2px; text-transform: uppercase; margin-top: 3px; }
.h-date { font-size: 9px; color: #94a3b8; }

/* ── HERO ── */
.hero { background: #1e293b; padding: 20px 32px; margin-top: 20px; border-top: 1px solid #334155; }
.hero-tbl { width: 100%; border-collapse: collapse; }
.hero-left { vertical-align: middle; }
.hero-right { vertical-align: middle; text-align: right; width: 110px; }
.hero-badge { display: inline-block; background: #6366f1; color: #ffffff; font-size: 7px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; padding: 3px 9px; border-radius: 99px; margin-bottom: 8px; }
.hero-title { font-size: 24px; font-weight: 900; color: #ffffff; letter-spacing: -0.5px; line-height: 1.15; }
.hero-sub   { font-size: 9px; color: #64748b; margin-top: 4px; }
.score-box  { background: #6366f1; border-radius: 10px; padding: 12px 16px; text-align: center; display: inline-block; }
.score-num  { font-size: 30px; font-weight: 900; color: #ffffff; line-height: 1; }
.score-pct  { font-size: 13px; color: #a5b4fc; font-weight: 700; }
.score-lbl  { font-size: 7px; color: #a5b4fc; text-transform: uppercase; letter-spacing: 1.5px; margin-top: 2px; }

/* ── READINESS PILL ── */
.pill { display: inline-block; padding: 3px 11px; border-radius: 99px; font-size: 8px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-top: 8px; border: 1px solid; }
.pill-e { background: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
.pill-g { background: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
.pill-d { background: #fff7ed; color: #c2410c; border-color: #fed7aa; }
.pill-l { background: #fef2f2; color: #b91c1c; border-color: #fecaca; }

/* ── STATS ROW ── */
.stats-tbl { width: 100%; border-collapse: collapse; background: #f8fafc; border-top: 1px solid #e2e8f0; border-bottom: 2px solid #e2e8f0; }
.stat-td { text-align: center; padding: 13px 8px; border-right: 1px solid #e2e8f0; width: 25%; }
.stat-td:last-child { border-right: none; }
.stat-num { font-size: 19px; font-weight: 900; line-height: 1; }
.c-green { color: #16a34a; } .c-orange { color: #ea580c; } .c-purple { color: #6366f1; } .c-blue { color: #0284c7; }
.stat-lbl { font-size: 8px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-top: 3px; }

/* ── BODY ── */
.body { padding: 22px 32px; }
.sec { margin-bottom: 22px; }
.sec-head { margin-bottom: 10px; }
.sec-dot { display: inline-block; width: 7px; height: 7px; border-radius: 50%; vertical-align: middle; margin-right: 7px; }
.sd-p { background: #6366f1; } .sd-g { background: #16a34a; } .sd-b { background: #0284c7; } .sd-s { background: #475569; }
.sec-title { font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: #475569; vertical-align: middle; }
.sec-badge { display: inline-block; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 99px; font-size: 8px; font-weight: 700; color: #64748b; padding: 1px 7px; margin-left: 7px; vertical-align: middle; }

/* ── PROGRESS ── */
.prog-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px 18px; }
.prog-tbl  { width: 100%; border-collapse: collapse; margin-bottom: 4px; }
.prog-lbl-td { font-size: 11px; font-weight: 600; color: #1e293b; vertical-align: middle; }
.prog-val-td { text-align: right; font-size: 12px; font-weight: 900; vertical-align: middle; width: 50px; }
.c-prog-p { color: #6366f1; } .c-prog-g { color: #16a34a; }
.prog-track { background: #e2e8f0; height: 8px; width: 100%; margin-top: 5px; margin-bottom: 12px; }
.prog-fill  { height: 8px; }
.pf-p { background: #6366f1; } .pf-g { background: #16a34a; }
.prog-comment { font-size: 9.5px; color: #64748b; margin-top: 2px; font-style: italic; }

/* ── SKILL CARDS ── */
.skills-tbl { width: 100%; border-collapse: collapse; }
.sk-col-l { width: 49%; vertical-align: top; }
.sk-col-r { width: 49%; vertical-align: top; padding-left: 2%; }
.sk-card { background: #ffffff; border: 1px solid #e2e8f0; width: 100%; }
.sk-hdr { padding: 9px 12px; }
.sk-hdr-g { background: #f0fdf4; border-bottom: 2px solid #bbf7d0; }
.sk-hdr-o { background: #fff7ed; border-bottom: 2px solid #fed7aa; }
.sk-icon { display: inline-block; width: 18px; height: 18px; border-radius: 50%; text-align: center; line-height: 18px; font-size: 10px; font-weight: 900; vertical-align: middle; margin-right: 6px; }
.sk-icon-g { background: #16a34a; color: #ffffff; }
.sk-icon-o { background: #ea580c; color: #ffffff; }
.sk-htitle { font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; vertical-align: middle; }
.sk-htitle-g { color: #15803d; } .sk-htitle-o { color: #c2410c; }
.sk-hcount { font-size: 8px; color: #94a3b8; display: block; margin-top: 1px; padding-left: 24px; }
.sk-item { width: 100%; border-collapse: collapse; border-bottom: 1px solid #f8fafc; }
.sk-item-alt { background: #fafafa; }
.sk-td-dot  { width: 14px; padding: 6px 6px 6px 12px; vertical-align: middle; }
.sk-td-name { padding: 6px 6px; vertical-align: middle; font-size: 10.5px; color: #334155; font-weight: 500; text-transform: capitalize; }
.sk-td-bar  { width: 54px; padding: 6px 12px 6px 0; vertical-align: middle; text-align: right; }
.sdot { display: inline-block; width: 5px; height: 5px; border-radius: 50%; }
.sdot-g { background: #16a34a; } .sdot-o { background: #ea580c; }
.mb-track { display: inline-block; width: 46px; height: 3px; background: #f1f5f9; vertical-align: middle; }
.mb-fill  { height: 3px; }
.mb-g { background: #16a34a; } .mb-o { background: #ea580c; }
.sk-empty { padding: 10px 12px; font-size: 10px; color: #94a3b8; font-style: italic; }

/* ── ACTION PLAN ── */
.callout { background: #eff6ff; border-left: 3px solid #6366f1; padding: 8px 12px; font-size: 10px; color: #1e40af; margin-bottom: 10px; line-height: 1.5; }
.steps-wrap { background: #f8fafc; border: 1px solid #e2e8f0; }
.step-tbl { width: 100%; border-collapse: collapse; }
.step-td-n { width: 36px; padding: 11px 0 11px 14px; vertical-align: top; }
.step-badge { display: inline-block; width: 22px; height: 22px; background: #6366f1; color: #ffffff; font-size: 10px; font-weight: 900; text-align: center; line-height: 22px; }
.step-td-b { padding: 11px 14px 11px 6px; vertical-align: top; font-size: 10.5px; color: #475569; line-height: 1.55; border-bottom: 1px solid #f1f5f9; }
.step-td-b strong { color: #1e293b; font-weight: 700; }
.step-last { border-bottom: none !important; }

/* ── RESOURCES ── */
.res-tbl { width: 100%; border-collapse: collapse; }
.res-td { vertical-align: top; width: 50%; }
.res-td-r { padding-left: 8px; }
.res-box { background: #f8faff; border: 1px solid #e0e7ff; padding: 9px 12px; margin-bottom: 6px; }
.res-title { font-size: 10px; font-weight: 700; color: #4f46e5; }
.res-desc  { font-size: 8.5px; color: #94a3b8; margin-top: 2px; }

/* ── ALT CAREERS ── */
.alt-tbl { width: 100%; border-collapse: collapse; }
.alt-td { vertical-align: top; padding-right: 8px; }
.alt-td-last { padding-right: 0; }
.alt-inner { background: #ffffff; border: 1px solid #e2e8f0; padding: 12px; }
.alt-rank { font-size: 7px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 4px; }
.alt-name { font-size: 10.5px; font-weight: 700; color: #1e293b; margin-bottom: 8px; line-height: 1.3; }
.alt-pct  { font-size: 17px; font-weight: 900; color: #6366f1; line-height: 1; margin-bottom: 5px; }
.alt-pct-sm { font-size: 10px; color: #a5b4fc; font-weight: 600; }
.alt-bar  { background: #e0e7ff; height: 4px; }
.alt-fill { background: #6366f1; height: 4px; }

/* ── FOOTER ── */
.footer { background: #0f172a; padding: 11px 32px; }
.footer-tbl { width: 100%; border-collapse: collapse; }
.footer-l { font-size: 8px; color: #475569; vertical-align: middle; }
.footer-r { font-size: 8px; color: #475569; vertical-align: middle; text-align: right; }
.footer-brand { color: #6366f1; font-weight: 700; }

a { color: #4f46e5; text-decoration: underline; }
</style>
</head>
<body>

<?php
    // ── Data resolution ─────────────────────────────────────────
    $careerName = is_string($career) ? $career : ($career->career_name ?? 'Career Path Identified');

    // Safe topPercentage — no closure, works in all PHP versions
    $topPct = session('topPercentage');
    if ($topPct === null) {
        $t = count($matchedSkills) + count($missingSkills);
        $topPct = $t > 0 ? (int) round((count($matchedSkills) / $t) * 100) : 0;
    }
    $topPct = (int) $topPct;

    $allRecs    = session('allRecommendations', []);
    $allRecs    = is_array($allRecs) ? $allRecs : [];
    $altCareers = array_values(array_filter($allRecs, function($r) use ($careerName) {
        return isset($r['career']) && $r['career'] !== $careerName;
    }));
    $altCareers = array_slice($altCareers, 0, 4);

    $mc = count($matchedSkills);
    $ms = count($missingSkills);
    $tc = $mc + $ms;
    $ac = count($altCareers);
    $coveragePct = $tc > 0 ? (int) round(($mc / $tc) * 100) : 0;

    if ($topPct >= 80)     { $level = 'Excellent';   $pill = 'pill-e'; $comment = 'You are strongly positioned for this career. Deepen expertise and build real-world projects.'; }
    elseif ($topPct >= 60) { $level = 'Good';         $pill = 'pill-g'; $comment = 'Solid foundation. Bridging a few skill gaps will make a meaningful difference.'; }
    elseif ($topPct >= 40) { $level = 'Developing';   $pill = 'pill-d'; $comment = 'A base to build on. Focus on the top missing skills as your immediate priority.'; }
    else                   { $level = 'Early Stage';  $pill = 'pill-l'; $comment = 'Room to grow — every professional started somewhere. Begin with the recommended roadmap.'; }

    // Career-specific learning link
    $cl = strtolower($careerName);
    $learnUrl   = 'https://www.coursera.org/search?query=' . urlencode($careerName);
    $learnLabel = 'Learn Missing Skills';
    $learnDesc  = 'Coursera — structured courses for your skill gaps';
    if (strpos($cl,'cyber')!==false || strpos($cl,'security')!==false || strpos($cl,'hacker')!==false) {
        $learnUrl = 'https://tryhackme.com'; $learnLabel = 'Practice Cybersecurity'; $learnDesc = 'TryHackMe — hands-on cybersecurity labs';
    } elseif (strpos($cl,'cloud')!==false || strpos($cl,'devops')!==false) {
        $learnUrl = 'https://acloudguru.com'; $learnLabel = 'Cloud Training'; $learnDesc = 'A Cloud Guru — AWS, Azure, GCP certifications';
    } elseif (strpos($cl,'developer')!==false || strpos($cl,'engineer')!==false) {
        $learnUrl = 'https://roadmap.sh'; $learnLabel = 'Developer Roadmaps'; $learnDesc = 'roadmap.sh — community-driven learning paths';
    }

    $encoded     = urlencode($careerName);
    $stepCount   = 0;
?>

<div class="page">

{{-- ── HEADER ── --}}
<div class="header">
    <table class="hdr-tbl">
        <tr>
            <td class="hdr-brand-td">
                <span class="h-dot"></span><span class="h-name">Skillly</span>
                <div class="h-tag" style="padding-left:15px;">Career Guidance Report</div>
            </td>
            <td class="hdr-meta-td">
                <div style="font-size:8px; color:#475569; text-transform:uppercase; letter-spacing:1px;">Generated</div>
                <div class="h-date">{{ now()->format('d M Y') }} at {{ now()->format('g:i A') }}</div>
            </td>
        </tr>
    </table>

    {{-- ── HERO ── --}}
    <div class="hero">
        <table class="hero-tbl">
            <tr>
                <td class="hero-left">
                    <div class="hero-badge">Top Career Match</div>
                    <div class="hero-title">{{ $careerName }}</div>
                    <div class="hero-sub">Recommended based on your extracted resume skills and experience</div>
                    <div class="pill {{ $pill }}">{{ $level }}</div>
                </td>
                <td class="hero-right">
                    <div class="score-box">
                        <div class="score-num">{{ $topPct }}<span class="score-pct">%</span></div>
                        <div class="score-lbl">Match Score</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

{{-- ── STATS ── --}}
<table class="stats-tbl">
    <tr>
        <td class="stat-td"><div class="stat-num c-green">{{ $mc }}</div><div class="stat-lbl">Skills Matched</div></td>
        <td class="stat-td"><div class="stat-num c-orange">{{ $ms }}</div><div class="stat-lbl">To Develop</div></td>
        <td class="stat-td"><div class="stat-num c-purple">{{ $tc }}</div><div class="stat-lbl">Evaluated</div></td>
        <td class="stat-td"><div class="stat-num c-blue">{{ $ac }}</div><div class="stat-lbl">Alt. Matches</div></td>
    </tr>
</table>

{{-- ── BODY ── --}}
<div class="body">

    {{-- READINESS --}}
    <div class="sec">
        <div class="sec-head">
            <span class="sec-dot sd-p"></span>
            <span class="sec-title">Career Readiness Overview</span>
        </div>
        <div class="prog-card">
            <table class="prog-tbl">
                <tr>
                    <td class="prog-lbl-td">Overall Match Score &mdash; {{ $careerName }}</td>
                    <td class="prog-val-td c-prog-p">{{ $topPct }}%</td>
                </tr>
            </table>
            <div class="prog-track"><div class="prog-fill pf-p" style="width:{{ $topPct }}%;"></div></div>
            <table class="prog-tbl">
                <tr>
                    <td class="prog-lbl-td">Skills Coverage</td>
                    <td class="prog-val-td c-prog-g">{{ $coveragePct }}%</td>
                </tr>
            </table>
            <div class="prog-track" style="margin-bottom:8px;"><div class="prog-fill pf-g" style="width:{{ $coveragePct }}%;"></div></div>
            <div class="prog-comment">{{ $comment }}</div>
        </div>
    </div>

    {{-- SKILLS --}}
    <div class="sec">
        <div class="sec-head">
            <span class="sec-dot sd-g"></span>
            <span class="sec-title">Skill Analysis</span>
            <span class="sec-badge">{{ $mc }} matched &nbsp;&middot;&nbsp; {{ $ms }} to develop</span>
        </div>
        <table class="skills-tbl">
            <tr>
                {{-- Matched --}}
                <td class="sk-col-l">
                    <div class="sk-card">
                        <div class="sk-hdr sk-hdr-g">
                            <span class="sk-icon sk-icon-g">&#10003;</span>
                            <span class="sk-htitle sk-htitle-g">Matched Skills</span>
                            <span class="sk-hcount">{{ $mc }} skill{{ $mc !== 1 ? 's' : '' }} found on your resume</span>
                        </div>
                        @forelse($matchedSkills as $i => $skill)
                        <table class="sk-item {{ $i % 2 !== 0 ? 'sk-item-alt' : '' }}">
                            <tr>
                                <td class="sk-td-dot"><span class="sdot sdot-g"></span></td>
                                <td class="sk-td-name">{{ ucwords($skill) }}</td>
                                <td class="sk-td-bar">
                                    <div class="mb-track"><div class="mb-fill mb-g" style="width:{{ min(70 + ($i * 3 % 30), 100) }}%;"></div></div>
                                </td>
                            </tr>
                        </table>
                        @empty
                        <div class="sk-empty">No matched skills detected.</div>
                        @endforelse
                    </div>
                </td>
                {{-- Missing --}}
                <td class="sk-col-r">
                    <div class="sk-card">
                        <div class="sk-hdr sk-hdr-o">
                            <span class="sk-icon sk-icon-o">+</span>
                            <span class="sk-htitle sk-htitle-o">Skills to Develop</span>
                            <span class="sk-hcount">{{ $ms }} skill{{ $ms !== 1 ? 's' : '' }} to strengthen your profile</span>
                        </div>
                        @forelse($missingSkills as $i => $skill)
                        <table class="sk-item {{ $i % 2 !== 0 ? 'sk-item-alt' : '' }}">
                            <tr>
                                <td class="sk-td-dot"><span class="sdot sdot-o"></span></td>
                                <td class="sk-td-name">{{ ucwords($skill) }}</td>
                                <td class="sk-td-bar">
                                    <div class="mb-track"><div class="mb-fill mb-o" style="width:{{ max(20, 65 - ($i * 4 % 45)) }}%;"></div></div>
                                </td>
                            </tr>
                        </table>
                        @empty
                        <div class="sk-empty">No critical gaps detected. Great work!</div>
                        @endforelse
                    </div>
                </td>
            </tr>
        </table>
    </div>

    {{-- ACTION PLAN --}}
    <div class="sec">
        <div class="sec-head">
            <span class="sec-dot sd-b"></span>
            <span class="sec-title">Recommended Action Plan</span>
        </div>
        @if(!empty($missingSkills))
        <div class="callout">Your next move is clear. Start with the highest-priority skill below, build something real with it, then work through the list. Consistency over intensity.</div>
        @endif
        <div class="steps-wrap">
            <table class="step-tbl">
                @if(!empty($missingSkills))
                    @php $stepCount = 1; @endphp
                    <tr>
                        <td class="step-td-n"><div class="step-badge">1</div></td>
                        <td class="step-td-b"><strong>Learn {{ ucwords($missingSkills[0]) }}.</strong> Follow a structured course or tutorial. Build a small working project and document it on GitHub or a portfolio to demonstrate practical ability.</td>
                    </tr>
                    @if(isset($missingSkills[1]))
                    @php $stepCount = 2; @endphp
                    <tr>
                        <td class="step-td-n"><div class="step-badge">2</div></td>
                        <td class="step-td-b"><strong>Add {{ ucwords($missingSkills[1]) }} to your roadmap.</strong> Once you have hands-on experience from step one, move to this skill. Even a learning project on your resume signals initiative.</td>
                    </tr>
                    @endif
                    @php $stepCount++; @endphp
                    <tr>
                        <td class="step-td-n"><div class="step-badge">{{ $stepCount }}</div></td>
                        <td class="step-td-b"><strong>Update your resume.</strong> Highlight your strongest skills &mdash; <strong>{{ collect($matchedSkills)->take(3)->map('ucwords')->implode(', ') }}</strong> &mdash; with specific examples and measurable results.</td>
                    </tr>
                    @php $stepCount++; @endphp
                    <tr>
                        <td class="step-td-n"><div class="step-badge">{{ $stepCount }}</div></td>
                        <td class="step-td-b step-last"><strong>Stay consistent.</strong> 30 minutes of focused daily practice compounds faster than occasional long sessions. Re-analyse your resume as you grow.</td>
                    </tr>
                @else
                    <tr>
                        <td class="step-td-n"><div class="step-badge">1</div></td>
                        <td class="step-td-b"><strong>Build production-grade projects.</strong> Your skills are well-aligned with {{ $careerName }}. Shipping real projects is the most effective differentiator for prospective employers.</td>
                    </tr>
                    <tr>
                        <td class="step-td-n"><div class="step-badge">2</div></td>
                        <td class="step-td-b"><strong>Deepen mastery of your core skills.</strong> Advanced proficiency in <strong>{{ collect($matchedSkills)->take(2)->map('ucwords')->implode(' and ') }}</strong> will set you apart from candidates with similar breadth.</td>
                    </tr>
                    <tr>
                        <td class="step-td-n"><div class="step-badge">3</div></td>
                        <td class="step-td-b step-last"><strong>Contribute to open source.</strong> Real contributions demonstrate collaborative, production-grade development experience &mdash; exactly what employers value.</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>

    {{-- RESOURCES --}}
    <div class="sec">
        <div class="sec-head">
            <span class="sec-dot sd-s"></span>
            <span class="sec-title">Useful Resources</span>
        </div>
        <table class="res-tbl">
            <tr>
                <td class="res-td">
                    <div class="res-box">
                        <a href="https://www.glassdoor.com/Salaries/{{ $encoded }}-salary-SRCH_KO0,{{ strlen($careerName) }}.htm" class="res-title">Check {{ $careerName }} Salaries</a>
                        <div class="res-desc">Glassdoor &mdash; real salary data by location and experience level</div>
                    </div>
                    <div class="res-box">
                        <a href="{{ $learnUrl }}" class="res-title">{{ $learnLabel }}</a>
                        <div class="res-desc">{{ $learnDesc }}</div>
                    </div>
                </td>
                <td class="res-td res-td-r">
                    <div class="res-box">
                        <a href="https://www.linkedin.com/jobs/search/?keywords={{ $encoded }}" class="res-title">Find {{ $careerName }} Jobs</a>
                        <div class="res-desc">LinkedIn Jobs &mdash; current openings matching your profile</div>
                    </div>
                    <div class="res-box">
                        <a href="https://github.com" class="res-title">Build Your Portfolio</a>
                        <div class="res-desc">GitHub &mdash; showcase your projects to prospective employers</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    {{-- ALT CAREERS --}}
    @if(!empty($altCareers))
    <div class="sec">
        <div class="sec-head">
            <span class="sec-dot sd-s"></span>
            <span class="sec-title">Alternative Career Matches</span>
            <span class="sec-badge">{{ $ac }} other paths matched your profile</span>
        </div>
        <div class="callout">These career paths also showed strong alignment with your skills and could serve as alternative or complementary career directions.</div>
        <table class="alt-tbl">
            <tr>
                @foreach($altCareers as $i => $alt)
                <td class="alt-td {{ $i === count($altCareers) - 1 ? 'alt-td-last' : '' }}">
                    <div class="alt-inner">
                        <div class="alt-rank">Match #{{ $i + 2 }}</div>
                        <div class="alt-name">
                            <a href="https://www.linkedin.com/jobs/search/?keywords={{ urlencode($alt['career']) }}" style="color:#1e293b; text-decoration:none; font-weight:700;">{{ $alt['career'] }}</a>
                        </div>
                        <div class="alt-pct">{{ $alt['percentage'] }}<span class="alt-pct-sm">%</span></div>
                        <div class="alt-bar"><div class="alt-fill" style="width:{{ min((float)$alt['percentage'], 100) }}%;"></div></div>
                    </div>
                </td>
                @endforeach
            </tr>
        </table>
    </div>
    @endif

</div>{{-- /body --}}

{{-- ── FOOTER ── --}}
<div class="footer">
    <table class="footer-tbl">
        <tr>
            <td class="footer-l">Confidential &mdash; Generated for personal career use only &mdash; Do not distribute</td>
            <td class="footer-r">Powered by <span class="footer-brand">Skillly</span> &bull; {{ now()->format('Y') }}</td>
        </tr>
    </table>
</div>

</div>{{-- /page --}}
</body>
</html>