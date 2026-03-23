@extends('layouts.app')

@section('title', 'Privacy Policy — Skillly')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">

        {{-- Header --}}
        <div class="text-center mb-5">
            <div class="policy-icon mx-auto mb-4">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h1 class="display-6 fw-bold mb-2">Privacy Policy</h1>
            <p class="text-secondary">Last updated: {{ date('F d, Y') }}</p>
        </div>

        {{-- Intro card --}}
        <div class="glass-panel mb-4 intro-card">
            <div class="d-flex gap-3 align-items-start">
                <div class="policy-badge">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">Our commitment to your privacy</h5>
                    <p class="text-secondary mb-0" style="font-size:0.9rem; line-height:1.7;">
                        Skillly is a career guidance tool built to help you — not to collect, sell, or exploit your data.
                        This policy explains clearly what we collect, why we collect it, and how we protect it.
                        We've written it in plain language so you actually understand it.
                    </p>
                </div>
            </div>
        </div>

        {{-- Sections --}}
        <div class="policy-sections">

            {{-- 1 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">1</div>
                    <h2 class="section-title">Who we are</h2>
                </div>
                <div class="section-body">
                    <p>
                        Skillly is a web-based resume analysis and career guidance application.
                        It is developed and maintained as an academic project. The application
                        allows users to upload their resume, receive AI-assisted career recommendations,
                        and download a career guidance report.
                    </p>
                    <p>
                        For any privacy-related questions, you may contact us at:
                        <a href="mailto:privacy@skillly.app" class="policy-link">privacy@skillly.app</a>
                    </p>
                </div>
            </div>

            {{-- 2 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">2</div>
                    <h2 class="section-title">What information we collect</h2>
                </div>
                <div class="section-body">
                    <p class="mb-3">We collect only what is necessary to provide the service:</p>

                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon green"><i class="fa-solid fa-user"></i></div>
                            <div>
                                <div class="info-label">Account information</div>
                                <div class="info-desc">If you register, we collect your name and email address. Your password is encrypted and never stored in plain text.</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon blue"><i class="fa-solid fa-file-lines"></i></div>
                            <div>
                                <div class="info-label">Resume content</div>
                                <div class="info-desc">Text extracted from your uploaded resume is used solely for skill analysis. The file itself is not permanently stored.</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon purple"><i class="fa-solid fa-chart-line"></i></div>
                            <div>
                                <div class="info-label">Analysis results</div>
                                <div class="info-desc">For registered users, your career match, skill gaps, readiness score, and chat conversation are saved to your account history.</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon amber"><i class="fa-solid fa-cookie-bite"></i></div>
                            <div>
                                <div class="info-label">Session data</div>
                                <div class="info-desc">We use session cookies to maintain your login state. No third-party tracking or advertising cookies are used.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">3</div>
                    <h2 class="section-title">How we use your information</h2>
                </div>
                <div class="section-body">
                    <p>We use the information we collect for the following purposes:</p>
                    <ul class="policy-list">
                        <li>To extract and analyse skills from your resume and generate career recommendations</li>
                        <li>To save your analysis history so you can access it later (registered users only)</li>
                        <li>To generate and allow you to download your career guidance PDF report</li>
                        <li>To send a password reset email if you request one</li>
                        <li>To maintain your login session while you are using the application</li>
                    </ul>
                    <div class="policy-highlight">
                        <i class="fa-solid fa-circle-check"></i>
                        We do <strong>not</strong> use your data for advertising, profiling, or any purpose beyond providing the Skillly service.
                    </div>
                </div>
            </div>

            {{-- 4 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">4</div>
                    <h2 class="section-title">Resume data & guest users</h2>
                </div>
                <div class="section-body">
                    <p>
                        <strong>Guest users</strong> (not logged in) can use the full analysis feature.
                        Their resume text is processed in memory only — no resume file is saved to permanent storage
                        and no personal data is retained after the browser session ends.
                    </p>
                    <p>
                        <strong>Registered users</strong> have their analysis results (career match, skills, score,
                        conversation) saved to their account so they can revisit and re-download reports at any time.
                        Resume files themselves are never stored permanently — only the extracted analysis data is saved.
                    </p>
                </div>
            </div>

            {{-- 5 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">5</div>
                    <h2 class="section-title">Data sharing & third parties</h2>
                </div>
                <div class="section-body">
                    <p>
                        We do not sell, rent, or share your personal data with any third parties for commercial purposes.
                    </p>
                    <p>Your data may only be disclosed in the following circumstances:</p>
                    <ul class="policy-list">
                        <li>If required by law, regulation, or legal process</li>
                        <li>To protect the rights, property, or safety of users or the public</li>
                    </ul>
                    <p>
                        We do not integrate with any third-party analytics, advertising networks, or social media tracking tools.
                    </p>
                </div>
            </div>

            {{-- 6 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">6</div>
                    <h2 class="section-title">Data security</h2>
                </div>
                <div class="section-body">
                    <p>We take reasonable technical and organisational measures to protect your data, including:</p>
                    <ul class="policy-list">
                        <li>All passwords are hashed using Laravel's bcrypt implementation — never stored in plain text</li>
                        <li>CSRF protection is enforced on all form submissions</li>
                        <li>File uploads are validated for type and size before processing</li>
                        <li>Session data is managed securely using Laravel's session driver</li>
                        <li>Database access is restricted using environment-based credentials</li>
                    </ul>
                    <p>
                        No system is completely immune to security risks. While we take every reasonable precaution,
                        we cannot guarantee absolute security.
                    </p>
                </div>
            </div>

            {{-- 7 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">7</div>
                    <h2 class="section-title">Your rights</h2>
                </div>
                <div class="section-body">
                    <p>As a registered user, you have the following rights regarding your data:</p>
                    <div class="rights-grid">
                        <div class="right-item">
                            <i class="fa-solid fa-eye"></i>
                            <div>
                                <div class="right-title">Access</div>
                                <div class="right-desc">View all your saved analyses from your history dashboard at any time.</div>
                            </div>
                        </div>
                        <div class="right-item">
                            <i class="fa-solid fa-trash"></i>
                            <div>
                                <div class="right-title">Deletion</div>
                                <div class="right-desc">Delete individual analyses from your history at any time.</div>
                            </div>
                        </div>
                        <div class="right-item">
                            <i class="fa-solid fa-user-slash"></i>
                            <div>
                                <div class="right-title">Account removal</div>
                                <div class="right-desc">Contact us to request full deletion of your account and all associated data.</div>
                            </div>
                        </div>
                        <div class="right-item">
                            <i class="fa-solid fa-envelope"></i>
                            <div>
                                <div class="right-title">Questions</div>
                                <div class="right-desc">Contact us at <a href="mailto:privacy@skillly.app" class="policy-link">privacy@skillly.app</a> for any privacy concerns.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 8 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">8</div>
                    <h2 class="section-title">Cookies</h2>
                </div>
                <div class="section-body">
                    <p>
                        Skillly uses only essential cookies necessary for the application to function:
                    </p>
                    <ul class="policy-list">
                        <li><strong>Session cookie</strong> — keeps you logged in during your visit</li>
                        <li><strong>CSRF token cookie</strong> — protects against cross-site request forgery attacks</li>
                    </ul>
                    <p>
                        We do not use tracking cookies, marketing cookies, or any cookies from third-party services.
                        You can disable cookies in your browser settings, but doing so may prevent the application from working correctly.
                    </p>
                </div>
            </div>

            {{-- 9 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">9</div>
                    <h2 class="section-title">Children's privacy</h2>
                </div>
                <div class="section-body">
                    <p>
                        Skillly is not directed at children under the age of 13. We do not knowingly collect
                        personal information from children. If you believe a child has provided us with personal
                        information, please contact us and we will delete it promptly.
                    </p>
                </div>
            </div>

            {{-- 10 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">10</div>
                    <h2 class="section-title">Changes to this policy</h2>
                </div>
                <div class="section-body">
                    <p>
                        We may update this Privacy Policy from time to time. When we do, we will update the
                        "Last updated" date at the top of this page. We encourage you to review this policy
                        periodically to stay informed about how we protect your information.
                    </p>
                    <p>
                        Continued use of Skillly after any changes constitutes your acceptance of the updated policy.
                    </p>
                </div>
            </div>

        </div>

        {{-- Footer CTA --}}
        <div class="glass-panel text-center mb-5" style="padding:2rem;">
            <p class="text-secondary mb-3" style="font-size:0.9rem;">
                Have a question about your privacy or your data?
            </p>
            <a href="mailto:privacy@skillly.app" class="btn btn-glow" style="padding:10px 24px; font-size:0.875rem;">
                <i class="fa-solid fa-envelope"></i> Contact Us
            </a>
            <div class="mt-3">
                <a href="{{ route('resume.index') }}" class="text-secondary small" style="text-decoration:none;">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Skillly
                </a>
            </div>
        </div>

    </div>
</div>

@endsection

@push('styles')
<style>

/* ── Icon header ── */
.policy-icon {
    width: 72px; height: 72px;
    background: rgba(99,102,241,0.12);
    border: 1px solid rgba(99,102,241,0.25);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.8rem; color: #a5b4fc;
}

/* ── Intro ── */
.intro-card { border-left: 3px solid #6366f1 !important; }
.policy-badge {
    width: 44px; height: 44px; flex-shrink: 0;
    background: rgba(99,102,241,0.1);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    color: #a5b4fc; font-size: 1.1rem;
}

/* ── Sections ── */
.policy-section { border-radius: 16px !important; padding: 1.75rem !important; }
.section-header {
    display: flex; align-items: center; gap: 14px; margin-bottom: 1.25rem;
}
.section-num {
    width: 32px; height: 32px; flex-shrink: 0;
    background: var(--accent-gradient);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.8rem; font-weight: 700; color: white;
}
.section-title {
    font-family: var(--font-sora);
    font-size: 1.05rem; font-weight: 700;
    color: var(--text-primary); margin: 0;
}
.section-body p {
    font-size: 0.9rem; color: var(--text-secondary);
    line-height: 1.75; margin-bottom: 0.85rem;
}
.section-body p:last-child { margin-bottom: 0; }
.section-body strong { color: var(--text-primary); }

/* ── Info grid ── */
.info-grid { display: flex; flex-direction: column; gap: 14px; }
.info-item { display: flex; align-items: flex-start; gap: 12px; }
.info-icon {
    width: 36px; height: 36px; flex-shrink: 0;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.85rem;
}
.info-icon.green  { background: rgba(34,197,94,0.1);  color: #86efac; }
.info-icon.blue   { background: rgba(99,102,241,0.1); color: #a5b4fc; }
.info-icon.purple { background: rgba(168,85,247,0.1); color: #d8b4fe; }
.info-icon.amber  { background: rgba(245,158,11,0.1); color: #fcd34d; }
.info-label { font-size: 0.85rem; font-weight: 600; color: var(--text-primary); margin-bottom: 2px; }
.info-desc  { font-size: 0.82rem; color: var(--text-secondary); line-height: 1.5; }

/* ── Policy list ── */
.policy-list {
    padding-left: 0; list-style: none;
    font-size: 0.875rem; color: var(--text-secondary);
    display: flex; flex-direction: column; gap: 8px;
    margin-bottom: 0.85rem;
}
.policy-list li {
    display: flex; align-items: flex-start; gap: 10px;
    line-height: 1.6;
}
.policy-list li::before {
    content: '→';
    color: #6366f1; font-weight: 700;
    flex-shrink: 0; margin-top: 1px;
}

/* ── Highlight box ── */
.policy-highlight {
    background: rgba(99,102,241,0.08);
    border: 1px solid rgba(99,102,241,0.2);
    border-radius: 10px; padding: 12px 16px;
    font-size: 0.85rem; color: #a5b4fc;
    display: flex; align-items: flex-start; gap: 10px;
    line-height: 1.6; margin-top: 1rem;
}
.policy-highlight i { margin-top: 2px; flex-shrink: 0; color: #22c55e; }
.policy-highlight strong { color: var(--text-primary); }

/* ── Rights grid ── */
.rights-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
@media (max-width: 576px) { .rights-grid { grid-template-columns: 1fr; } }
.right-item {
    display: flex; align-items: flex-start; gap: 12px;
    background: rgba(255,255,255,0.03);
    border: 1px solid var(--border-glass);
    border-radius: 10px; padding: 12px;
}
.right-item > i {
    color: #a5b4fc; font-size: 0.9rem;
    margin-top: 2px; flex-shrink: 0; width: 16px;
}
.right-title { font-size: 0.83rem; font-weight: 600; color: var(--text-primary); margin-bottom: 2px; }
.right-desc  { font-size: 0.78rem; color: var(--text-secondary); line-height: 1.5; }

/* ── Links ── */
.policy-link { color: #a5b4fc; text-decoration: none; font-weight: 500; }
.policy-link:hover { color: white; }
</style>
@endpush