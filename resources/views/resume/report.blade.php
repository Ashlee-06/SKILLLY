<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Skillly Career Report</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Helvetica Neue',Arial,sans-serif;background:#f1f5f9;color:#1e293b;font-size:12px;line-height:1.4;-webkit-print-color-adjust:exact;print-color-adjust:exact;}
.page{width:780px;margin:20px auto;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,0.08);}
.header{background:#0f172a;}
.header-top{display:flex;justify-content:space-between;align-items:center;padding:14px 24px 12px;}
.brand{display:flex;align-items:center;gap:6px;}
.brand-dot{width:8px;height:8px;background:#6366f1;border-radius:50%;}
.brand-name{font-size:18px;font-weight:900;color:#fff;letter-spacing:-0.5px;}
.brand-sep{width:1px;height:14px;background:#334155;}
.brand-tag{font-size:7px;color:#475569;letter-spacing:2px;text-transform:uppercase;}
.meta-label{font-size:7px;color:#475569;text-transform:uppercase;letter-spacing:1px;}
.meta-value{font-size:9px;color:#94a3b8;margin-top:1px;}
.career-hero{background:#1e293b;padding:16px 24px;display:flex;justify-content:space-between;align-items:center;gap:16px;}
.career-badge{display:inline-block;background:#6366f1;color:#fff;font-size:7px;font-weight:700;text-transform:uppercase;letter-spacing:1px;padding:2px 8px;border-radius:99px;margin-bottom:4px;}
.career-title{font-size:24px;font-weight:900;color:#fff;letter-spacing:-0.5px;line-height:1.1;}
.career-sub{font-size:9px;color:#64748b;margin-top:2px;}
.readiness-level{display:inline-block;padding:2px 10px;border-radius:99px;font-size:8px;font-weight:700;text-transform:uppercase;margin-top:5px;}
.readiness-level.excellent{background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;}
.readiness-level.good{background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;}
.readiness-level.developing{background:#fff7ed;color:#c2410c;border:1px solid #fed7aa;}
.readiness-level.early{background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;}
.score-badge{background:#6366f1;border-radius:10px;padding:8px 14px;text-align:center;flex-shrink:0;}
.score-num{font-size:28px;font-weight:900;color:#fff;line-height:1;}
.score-pct{font-size:12px;color:#a5b4fc;font-weight:700;}
.score-lbl{font-size:6px;color:#a5b4fc;text-transform:uppercase;margin-top:1px;}
.stats-row{background:#f8fafc;border-bottom:1px solid #e2e8f0;display:flex;}
.stat-cell{flex:1;padding:8px 0;text-align:center;border-right:1px solid #e2e8f0;}
.stat-cell:last-child{border-right:none;}
.stat-num{font-size:18px;font-weight:900;line-height:1;}
.stat-num.green{color:#16a34a;}
.stat-num.orange{color:#ea580c;}
.stat-num.purple{color:#6366f1;}
.stat-num.blue{color:#0284c7;}
.stat-label{font-size:7px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.5px;margin-top:1px;}
.body{padding:14px 24px;}
.section{margin-bottom:12px;}

/* Collapsible headers – interactive on screen, always open in print */
.sec-head{display:flex;align-items:center;gap:8px;margin-bottom:6px;cursor:pointer;user-select:none;padding:5px 8px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:6px;transition:background .15s;}
.sec-head:hover{background:#f1f5f9;}
.section-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0;}
.dot-green{background:#16a34a;}
.dot-purple{background:#6366f1;}
.dot-blue{background:#0284c7;}
.dot-slate{background:#475569;}
.section-title{font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#475569;}
.section-count{display:inline-block;background:#fff;border:1px solid #e2e8f0;border-radius:99px;font-size:7px;font-weight:700;color:#64748b;padding:0 5px;margin-left:5px;}
.chevron{margin-left:auto;font-size:9px;color:#94a3b8;transition:transform .2s;font-style:normal;}
.chevron.open{transform:rotate(180deg);}
.collapsible{overflow:hidden;transition:max-height .25s ease,opacity .2s ease;opacity:1;}
.collapsible.closed{max-height:0!important;opacity:0;pointer-events:none;}

/* Progress card */
.progress-card{background:#f8fafc;border:1px solid #e2e8f0;border-radius:6px;padding:8px 12px;}
.progress-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:4px;}
.progress-label{font-size:10px;font-weight:600;color:#1e293b;}
.progress-val{font-size:11px;font-weight:900;}
.progress-val.purple{color:#6366f1;}
.progress-val.green{color:#16a34a;}
.progress-track{margin:4px 0 2px;}
.progress-comment{font-size:9px;color:#64748b;margin-top:6px;font-style:italic;background:#fff;padding:4px 6px;border-radius:4px;border:1px solid #e2e8f0;}

/* Skills grid */
.skill-grid{display:flex;gap:8px;}
.skill-card{flex:1;background:#fff;border:1px solid #e2e8f0;border-radius:6px;overflow:hidden;}
.skill-card-header{display:flex;align-items:center;gap:8px;padding:5px 10px;}
.green-bg{background:#f0fdf4;border-bottom:1px solid #bbf7d0;}
.orange-bg{background:#fff7ed;border-bottom:1px solid #fed7aa;}
.skill-card-icon{width:16px;height:16px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.icon-green{background:#16a34a;}
.icon-orange{background:#ea580c;}
.skill-card-title{font-size:8px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;}
.skill-card-title.green{color:#15803d;}
.skill-card-title.orange{color:#c2410c;}
.skill-card-count{font-size:7px;color:#94a3b8;}
.skill-item{display:flex;align-items:center;gap:8px;padding:4px 10px;border-bottom:1px solid #f8fafc;}
.skill-item:last-child{border-bottom:none;}
.skill-item.alt{background:#fafafa;}
.sdot{width:5px;height:5px;border-radius:50%;flex-shrink:0;}
.sdot-green{background:#16a34a;}
.sdot-orange{background:#ea580c;}
.skill-name{flex:1;font-size:10px;color:#334155;font-weight:500;}
.mini-bar{width:40px;height:3px;background:#f1f5f9;border-radius:3px;}
.mini-bar-fill{height:3px;border-radius:3px;}
.fill-green{background:#16a34a;}
.fill-orange{background:#ea580c;}

/* Action plan */
.callout{background:#eff6ff;border-left:3px solid #6366f1;border-radius:0 4px 4px 0;padding:4px 8px;font-size:9px;color:#1e40af;margin-bottom:6px;line-height:1.4;}
.steps-wrap{background:#f8fafc;border:1px solid #e2e8f0;border-radius:6px;}
.step-row{display:flex;gap:8px;padding:6px 12px;border-bottom:1px solid #f1f5f9;align-items:flex-start;}
.step-row:last-child{border-bottom:none;}
.step-badge{width:18px;height:18px;border-radius:4px;background:#6366f1;color:#fff;font-size:8px;font-weight:900;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;}
.step-body{font-size:10px;color:#475569;line-height:1.4;}
.step-body strong{color:#1e293b;font-weight:700;}

/* Alt careers */
.alt-grid{display:flex;gap:6px;margin-top:4px;}
.alt-inner{flex:1;background:#fff;border:1px solid #e2e8f0;border-radius:6px;padding:8px;}
.alt-rank{font-size:6px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:2px;}
.alt-name{font-size:10px;font-weight:700;color:#1e293b;margin-bottom:4px;line-height:1.2;}
.alt-pct{font-size:14px;font-weight:900;color:#6366f1;line-height:1;margin-bottom:3px;}
.alt-pct span{font-size:8px;color:#a5b4fc;}
.alt-bar-track{height:4px;background:#e0e7ff;border-radius:99px;margin-top:4px;}
.alt-bar-fill{height:4px;background:#6366f1;border-radius:99px;}

/* Footer */
.footer{background:#0f172a;padding:8px 24px;display:flex;justify-content:space-between;align-items:center;}
.footer-left,.footer-right{font-size:7px;color:#475569;}
.footer-brand{color:#6366f1;font-weight:700;}

/* Print: always show all sections, remove shadows, ensure full width */
@media print {
  body{background:#fff;}
  .page{margin:0;border-radius:0;box-shadow:none;width:100%;}
  .sec-head{background:transparent!important;border-color:transparent!important;padding:0 0 4px 0;}
  .collapsible.closed{max-height:none!important;opacity:1!important;pointer-events:auto!important;}
  .chevron{display:none;}
}
</style>
</head>
<body>
<?php
// ===== DYNAMIC DATA =====
$career = $career ?? 'Career Path Identified';
$matchedSkills = $matchedSkills ?? ['Python', 'Machine Learning', 'TensorFlow', 'PyTorch', 'SQL'];
$missingSkills = $missingSkills ?? ['Deep Learning', 'Docker', 'AWS'];
$altCareers = $altCareers ?? [
    ['career' => 'Data Scientist', 'percentage' => 67.74],
    ['career' => 'Data Analyst', 'percentage' => 57.14],
    ['career' => 'Business Intelligence Developer', 'percentage' => 53.57],
    ['career' => 'AI Engineer', 'percentage' => 51.61]
];

$mc = count($matchedSkills);
$ms = count($missingSkills);
$tc = $mc + $ms;
$ac = count($altCareers);
$topPct = session('topPercentage') ?? (($tc > 0) ? round(($mc / $tc) * 100) : 0);

if ($topPct >= 80)      { $level = 'Excellent'; $levelClass = 'excellent'; $comment = 'You are strongly positioned for this career path. Deepen expertise and build real-world projects.'; }
elseif ($topPct >= 60)  { $level = 'Good'; $levelClass = 'good'; $comment = 'Solid foundation. Bridging a few skill gaps will make a meaningful difference.'; }
elseif ($topPct >= 40)  { $level = 'Developing'; $levelClass = 'developing'; $comment = 'A base to build on. Focus on the top missing skills as your immediate priority.'; }
else                    { $level = 'Early Stage'; $levelClass = 'early'; $comment = 'Room to grow — every professional started somewhere. Begin with the recommended roadmap.'; }

$coveragePct = $tc > 0 ? round(($mc / $tc) * 100) : 0;
?>
<div class="page">

  <div class="header">
    <div class="header-top">
      <div class="brand">
        <div class="brand-dot"></div>
        <span class="brand-name">Skillly</span>
        <div class="brand-sep"></div>
        <span class="brand-tag">Career Guidance Report</span>
      </div>
      <div style="text-align:right;">
        <div class="meta-label">Generated</div>
        <div class="meta-value"><?= date('d M Y \a\t g:i A') ?></div>
      </div>
    </div>
    <div class="career-hero">
      <div>
        <div class="career-badge">Top Career Match</div>
        <div class="career-title"><?= htmlspecialchars($career) ?></div>
        <div class="career-sub">Recommended based on your extracted resume skills and experience</div>
        <div class="readiness-level <?= $levelClass ?>"><?= $level ?></div>
      </div>
      <div class="score-badge">
        <div class="score-num"><?= $topPct ?><span class="score-pct">%</span></div>
        <div class="score-lbl">Match Score</div>
      </div>
    </div>
  </div>

  <div class="stats-row">
    <div class="stat-cell"><div class="stat-num green"><?= $mc ?></div><div class="stat-label">Skills Matched</div></div>
    <div class="stat-cell"><div class="stat-num orange"><?= $ms ?></div><div class="stat-label">Skills to Develop</div></div>
    <div class="stat-cell"><div class="stat-num purple"><?= $tc ?></div><div class="stat-label">Skills Evaluated</div></div>
    <div class="stat-cell"><div class="stat-num blue"><?= $ac ?></div><div class="stat-label">Alt. Career Matches</div></div>
  </div>

  <div class="body">

    <!-- READINESS SECTION -->
    <div class="section">
      <div class="sec-head" onclick="toggle('readiness')">
        <div class="section-dot dot-purple"></div>
        <span class="section-title">Career Readiness Overview</span>
        <i class="chevron open" id="chev-readiness">▼</i>
      </div>
      <div class="collapsible" id="readiness" data-mh="180px" style="max-height:180px;">
        <div class="progress-card">
          <div class="progress-row">
            <span class="progress-label">Overall Match Score — <?= htmlspecialchars($career) ?></span>
            <span class="progress-val purple"><?= $topPct ?>%</span>
          </div>
          <div class="progress-track">
            <svg width="100%" height="8" viewBox="0 0 700 8" preserveAspectRatio="none" style="display:block;">
              <rect width="700" height="8" rx="4" fill="#e2e8f0"/>
              <rect width="<?= $topPct * 7 ?>" height="8" rx="4" fill="#6366f1"/>
            </svg>
          </div>
          <div class="progress-row" style="margin-top:8px;">
            <span class="progress-label">Skills Coverage</span>
            <span class="progress-val green"><?= $coveragePct ?>%</span>
          </div>
          <div class="progress-track">
            <svg width="100%" height="8" viewBox="0 0 700 8" preserveAspectRatio="none" style="display:block;">
              <rect width="700" height="8" rx="4" fill="#e2e8f0"/>
              <rect width="<?= $coveragePct * 7 ?>" height="8" rx="4" fill="#16a34a"/>
            </svg>
          </div>
          <div class="progress-comment"><?= $comment ?></div>
        </div>
      </div>
    </div>

    <!-- SKILL ANALYSIS -->
    <div class="section">
      <div class="sec-head" onclick="toggle('skills')">
        <div class="section-dot dot-green"></div>
        <span class="section-title">Skill Analysis</span>
        <span class="section-count"><?= $mc ?> matched / <?= $ms ?> to develop</span>
        <i class="chevron open" id="chev-skills">▼</i>
      </div>
      <div class="collapsible" id="skills" data-mh="400px" style="max-height:400px;">
        <div class="skill-grid">
          <div class="skill-card">
            <div class="skill-card-header green-bg">
              <div class="skill-card-icon icon-green">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                  <path d="M1.5 5L4 7.5L8.5 2.5" stroke="white" stroke-width="1.6" stroke-linecap="round"/>
                </svg>
              </div>
              <div>
                <div class="skill-card-title green">Matched Skills</div>
                <div class="skill-card-count"><?= $mc ?> skill<?= $mc !== 1 ? 's' : '' ?> found on your resume</div>
              </div>
            </div>
            <?php foreach($matchedSkills as $i => $skill): ?>
            <div class="skill-item <?= $i % 2 !== 0 ? 'alt' : '' ?>">
              <div class="sdot sdot-green"></div>
              <div class="skill-name"><?= htmlspecialchars(ucwords($skill)) ?></div>
              <div class="mini-bar">
                <div class="mini-bar-fill fill-green" style="width:<?= min(70 + ($i * 3 % 30), 100) ?>%"></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <div class="skill-card">
            <div class="skill-card-header orange-bg">
              <div class="skill-card-icon icon-orange">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                  <path d="M5 1.5V8.5M1.5 5H8.5" stroke="white" stroke-width="1.6"/>
                </svg>
              </div>
              <div>
                <div class="skill-card-title orange">Skills to Develop</div>
                <div class="skill-card-count"><?= $ms ?> skill<?= $ms !== 1 ? 's' : '' ?> to strengthen your profile</div>
              </div>
            </div>
            <?php foreach($missingSkills as $i => $skill): ?>
            <div class="skill-item <?= $i % 2 !== 0 ? 'alt' : '' ?>">
              <div class="sdot sdot-orange"></div>
              <div class="skill-name"><?= htmlspecialchars(ucwords($skill)) ?></div>
              <div class="mini-bar">
                <div class="mini-bar-fill fill-orange" style="width:<?= max(20, 65 - ($i * 4 % 45)) ?>%"></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- ACTION PLAN -->
    <div class="section">
      <div class="sec-head" onclick="toggle('plan')">
        <div class="section-dot dot-blue"></div>
        <span class="section-title">Recommended Action Plan</span>
        <i class="chevron open" id="chev-plan">▼</i>
      </div>
      <div class="collapsible" id="plan" data-mh="280px" style="max-height:280px;">
        <?php if(!empty($missingSkills)): ?>
        <div class="callout">Your next move is clear. Start with the highest-priority skill below, build something real with it, then work through the list. Consistency over intensity.</div>
        <?php endif; ?>
        <div class="steps-wrap">
          <?php if(!empty($missingSkills)): ?>
          <div class="step-row">
            <div class="step-badge">1</div>
            <div class="step-body"><strong>Learn <?= ucwords($missingSkills[0]) ?>.</strong> Start with a structured tutorial or online course. Build a small working project and document it on GitHub or a portfolio.</div>
          </div>
          <?php if(isset($missingSkills[1])): ?>
          <div class="step-row">
            <div class="step-badge">2</div>
            <div class="step-body"><strong>Add <?= ucwords($missingSkills[1]) ?> to your roadmap.</strong> Once you have hands‑on experience with step one, move to this skill.</div>
          </div>
          <?php endif; ?>
          <div class="step-row">
            <div class="step-badge"><?= isset($missingSkills[1]) ? 3 : 2 ?></div>
            <div class="step-body"><strong>Update your resume.</strong> Feature your strongest skills — <strong><?= implode(', ', array_map('ucwords', array_slice($matchedSkills, 0, 3))) ?></strong> — with specific examples.</div>
          </div>
          <div class="step-row">
            <div class="step-badge"><?= isset($missingSkills[1]) ? 4 : 3 ?></div>
            <div class="step-body"><strong>Stay consistent.</strong> 30 minutes of focused daily practice compounds faster than occasional marathon sessions.</div>
          </div>
          <?php else: ?>
          <div class="step-row">
            <div class="step-badge">1</div>
            <div class="step-body"><strong>Build production‑grade projects.</strong> Your skills are well‑aligned with <?= htmlspecialchars($career) ?>. Shipping real projects is the most effective differentiator.</div>
          </div>
          <div class="step-row">
            <div class="step-badge">2</div>
            <div class="step-body"><strong>Deepen mastery of your core skills.</strong> Advanced proficiency in <strong><?= implode(' and ', array_map('ucwords', array_slice($matchedSkills, 0, 2))) ?></strong> will set you apart.</div>
          </div>
          <div class="step-row">
            <div class="step-badge">3</div>
            <div class="step-body"><strong>Contribute to open source.</strong> Real contributions demonstrate collaborative, production‑grade development experience.</div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- ALTERNATIVE CAREERS -->
    <?php if(!empty($altCareers)): ?>
    <div class="section">
      <div class="sec-head" onclick="toggle('alt')">
        <div class="section-dot dot-slate"></div>
        <span class="section-title">Alternative Career Matches</span>
        <span class="section-count"><?= count($altCareers) ?> other paths</span>
        <i class="chevron open" id="chev-alt">▼</i>
      </div>
      <div class="collapsible" id="alt" data-mh="200px" style="max-height:200px;">
        <div class="callout" style="margin-bottom:5px;">These career paths also showed strong alignment with your skills and could serve as alternative directions.</div>
        <div class="alt-grid">
          <?php foreach($altCareers as $i => $alt): ?>
          <div class="alt-inner">
            <div class="alt-rank">Match #<?= $i + 2 ?></div>
            <div class="alt-name"><?= htmlspecialchars($alt['career']) ?></div>
            <div class="alt-pct"><?= $alt['percentage'] ?><span>%</span></div>
            <div class="alt-bar-track">
              <div class="alt-bar-fill" style="width: <?= min($alt['percentage'], 100) ?>%"></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?php endif; ?>

  </div>

  <div class="footer">
    <div class="footer-left">Confidential — Generated for personal career use only — Do not distribute</div>
    <div class="footer-right">Powered by <span class="footer-brand">Skillly</span> &bull; <?= date('Y') ?></div>
  </div>

</div>

<script>
function toggle(id){
  var el = document.getElementById(id);
  var chev = document.getElementById('chev-'+id);
  if(el.classList.contains('closed')){
    el.classList.remove('closed');
    el.style.maxHeight = el.getAttribute('data-mh');
    el.style.opacity = '1';
    chev.classList.add('open');
  } else {
    el.style.maxHeight = '0';
    el.style.opacity = '0';
    el.classList.add('closed');
    chev.classList.remove('open');
  }
}
</script>
</body>
</html>