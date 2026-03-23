@extends('layouts.app')

@section('title', 'Terms of Service — Skillly')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">

        {{-- Header --}}
        <div class="text-center mb-5">
            <div class="policy-icon mx-auto mb-4">
                <i class="fa-solid fa-file-contract"></i>
            </div>
            <h1 class="display-6 fw-bold mb-2">Terms of Service</h1>
            <p class="text-secondary">Last updated: {{ date('F d, Y') }}</p>
        </div>

        {{-- Intro card --}}
        <div class="glass-panel mb-4 intro-card">
            <div class="d-flex gap-3 align-items-start">
                <div class="policy-badge">
                    <i class="fa-solid fa-circle-info"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">Please read these terms carefully</h5>
                    <p class="text-secondary mb-0" style="font-size:0.9rem; line-height:1.7;">
                        By accessing or using Skillly, you agree to be bound by these Terms of Service.
                        If you do not agree with any part of these terms, please do not use the application.
                        We've kept the language simple and straightforward.
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
                    <h2 class="section-title">Acceptance of terms</h2>
                </div>
                <div class="section-body">
                    <p>
                        By accessing Skillly — whether as a guest or registered user — you confirm that you
                        are at least 13 years of age and agree to comply with these Terms of Service and our
                        <a href="{{ route('privacy') }}" class="policy-link">Privacy Policy</a>.
                    </p>
                    <p>
                        If you are using Skillly on behalf of an organisation, you represent that you have the
                        authority to bind that organisation to these terms.
                    </p>
                </div>
            </div>

            {{-- 2 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">2</div>
                    <h2 class="section-title">Description of service</h2>
                </div>
                <div class="section-body">
                    <p>
                        Skillly is a web-based resume analysis and career guidance application. The service allows you to:
                    </p>
                    <ul class="policy-list">
                        <li>Upload a resume in PDF, DOC, or DOCX format for automated skill analysis</li>
                        <li>Receive career path recommendations based on extracted skills</li>
                        <li>Interact with a rule-based career guidance chatbot</li>
                        <li>Download a personalised career guidance PDF report</li>
                        <li>Save and revisit past analyses (registered users only)</li>
                    </ul>
                    <p>
                        Skillly uses rule-based logic — not artificial intelligence or machine learning — to generate
                        recommendations. Results are intended as guidance only and do not constitute professional
                        career or employment advice.
                    </p>
                </div>
            </div>

            {{-- 3 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">3</div>
                    <h2 class="section-title">User accounts</h2>
                </div>
                <div class="section-body">
                    <p>
                        Registration is optional. Guest users may use the core analysis features without creating an account.
                        Registered accounts unlock history saving and report re-downloading.
                    </p>
                    <p>If you create an account, you agree to:</p>
                    <ul class="policy-list">
                        <li>Provide accurate and truthful information during registration</li>
                        <li>Keep your password secure and not share it with others</li>
                        <li>Notify us immediately if you suspect unauthorised access to your account</li>
                        <li>Take responsibility for all activity that occurs under your account</li>
                    </ul>
                    <p>
                        We reserve the right to suspend or terminate accounts that violate these terms or
                        engage in abusive, fraudulent, or harmful behaviour.
                    </p>
                </div>
            </div>

            {{-- 4 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">4</div>
                    <h2 class="section-title">Acceptable use</h2>
                </div>
                <div class="section-body">
                    <p>You agree to use Skillly only for lawful purposes. You must not:</p>
                    <ul class="policy-list">
                        <li>Upload files containing malicious code, viruses, or harmful content</li>
                        <li>Attempt to gain unauthorised access to the system, server, or database</li>
                        <li>Use automated tools, bots, or scripts to scrape or abuse the service</li>
                        <li>Upload resumes or content that belong to another person without their consent</li>
                        <li>Use the service in any way that could damage, disable, or impair it</li>
                        <li>Attempt to reverse engineer, copy, or replicate any part of the application</li>
                    </ul>
                    <div class="policy-highlight">
                        <i class="fa-solid fa-triangle-exclamation" style="color:#f97316;"></i>
                        Violation of acceptable use policies may result in immediate account suspension and
                        reporting to relevant authorities where applicable.
                    </div>
                </div>
            </div>

            {{-- 5 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">5</div>
                    <h2 class="section-title">Your content</h2>
                </div>
                <div class="section-body">
                    <p>
                        You retain full ownership of any resume or content you upload to Skillly.
                        By uploading your resume, you grant us a limited, non-exclusive licence to process
                        its content solely for the purpose of generating your career analysis.
                    </p>
                    <p>
                        We do not claim any ownership over your resume content. Resume files are not
                        permanently stored — only extracted analysis data is saved for registered users.
                    </p>
                    <p>
                        You are solely responsible for ensuring that any content you upload does not infringe
                        the rights of any third party.
                    </p>
                </div>
            </div>

            {{-- 6 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">6</div>
                    <h2 class="section-title">Disclaimer of warranties</h2>
                </div>
                <div class="section-body">
                    <p>
                        Skillly is provided <strong>"as is"</strong> and <strong>"as available"</strong> without
                        warranties of any kind, either express or implied.
                    </p>
                    <ul class="policy-list">
                        <li>We do not guarantee that the service will be uninterrupted, error-free, or completely secure</li>
                        <li>Career recommendations are generated by rule-based logic and are for guidance purposes only</li>
                        <li>We do not guarantee employment outcomes or career success based on our recommendations</li>
                        <li>Skill extraction accuracy depends on the quality and formatting of the uploaded resume</li>
                    </ul>
                    <div class="policy-highlight">
                        <i class="fa-solid fa-circle-info"></i>
                        Skillly is a career <strong>guidance</strong> tool, not a professional career counselling service.
                        Always supplement our recommendations with advice from qualified career professionals.
                    </div>
                </div>
            </div>

            {{-- 7 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">7</div>
                    <h2 class="section-title">Limitation of liability</h2>
                </div>
                <div class="section-body">
                    <p>
                        To the fullest extent permitted by law, Skillly and its developers shall not be liable for:
                    </p>
                    <ul class="policy-list">
                        <li>Any indirect, incidental, or consequential damages arising from your use of the service</li>
                        <li>Loss of data, loss of employment opportunities, or financial losses</li>
                        <li>Inaccuracies in career recommendations or skill extraction results</li>
                        <li>Temporary unavailability of the service due to maintenance or technical issues</li>
                    </ul>
                    <p>
                        Our total liability to you for any claim arising from use of Skillly shall not exceed
                        the amount you have paid to use the service (which is zero, as Skillly is free).
                    </p>
                </div>
            </div>

            {{-- 8 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">8</div>
                    <h2 class="section-title">Intellectual property</h2>
                </div>
                <div class="section-body">
                    <p>
                        All content, design, code, branding, and materials that make up Skillly — including
                        the name, logo, interface design, and underlying application logic — are the intellectual
                        property of the Skillly development team.
                    </p>
                    <p>
                        You may not copy, reproduce, modify, distribute, or create derivative works based on
                        any part of Skillly without our express written permission.
                    </p>
                </div>
            </div>

            {{-- 9 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">9</div>
                    <h2 class="section-title">Termination</h2>
                </div>
                <div class="section-body">
                    <p>
                        You may stop using Skillly at any time. Registered users may request deletion of their
                        account and all associated data by contacting us at
                        <a href="mailto:privacy@skillly.app" class="policy-link">privacy@skillly.app</a>.
                    </p>
                    <p>
                        We reserve the right to suspend or terminate access to Skillly at any time, with or
                        without notice, for any user who violates these terms or for any operational reason.
                    </p>
                </div>
            </div>

            {{-- 10 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">10</div>
                    <h2 class="section-title">Changes to these terms</h2>
                </div>
                <div class="section-body">
                    <p>
                        We may revise these Terms of Service from time to time. When we do, we will update
                        the "Last updated" date at the top of this page. It is your responsibility to review
                        these terms periodically.
                    </p>
                    <p>
                        Continued use of Skillly after any changes to these terms constitutes your acceptance
                        of the revised terms.
                    </p>
                </div>
            </div>

            {{-- 11 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">11</div>
                    <h2 class="section-title">Governing law</h2>
                </div>
                <div class="section-body">
                    <p>
                        These Terms of Service are governed by and construed in accordance with applicable law.
                        Any disputes arising from your use of Skillly shall be subject to the exclusive jurisdiction
                        of the relevant courts.
                    </p>
                </div>
            </div>

            {{-- 12 --}}
            <div class="policy-section glass-panel mb-3">
                <div class="section-header">
                    <div class="section-num">12</div>
                    <h2 class="section-title">Contact us</h2>
                </div>
                <div class="section-body">
                    <p>
                        If you have any questions about these Terms of Service, please contact us:
                    </p>
                    <ul class="policy-list">
                        <li>Email: <a href="mailto:privacy@skillly.app" class="policy-link">privacy@skillly.app</a></li>
                        <li>Through the Skillly application contact form</li>
                    </ul>
                </div>
            </div>

        </div>

        {{-- Footer CTA --}}
        <div class="glass-panel text-center mb-5" style="padding:2rem;">
            <p class="text-secondary mb-3" style="font-size:0.9rem;">
                Have a question about these terms?
            </p>
            <a href="mailto:privacy@skillly.app" class="btn btn-glow" style="padding:10px 24px; font-size:0.875rem;">
                <i class="fa-solid fa-envelope"></i> Contact Us
            </a>
            <div class="mt-3 d-flex justify-content-center gap-3">
                <a href="{{ route('privacy') }}" class="text-secondary small" style="text-decoration:none;">
                    <i class="fa-solid fa-shield-halved me-1"></i> Privacy Policy
                </a>
                <span class="text-secondary small">·</span>
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
.policy-icon {
    width: 72px; height: 72px;
    background: rgba(99,102,241,0.12);
    border: 1px solid rgba(99,102,241,0.25);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.8rem; color: #a5b4fc;
}
.intro-card { border-left: 3px solid #6366f1 !important; }
.policy-badge {
    width: 44px; height: 44px; flex-shrink: 0;
    background: rgba(99,102,241,0.1);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    color: #a5b4fc; font-size: 1.1rem;
}
.policy-section { border-radius: 16px !important; padding: 1.75rem !important; }
.section-header { display: flex; align-items: center; gap: 14px; margin-bottom: 1.25rem; }
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
.policy-list {
    padding-left: 0; list-style: none;
    font-size: 0.875rem; color: var(--text-secondary);
    display: flex; flex-direction: column; gap: 8px;
    margin-bottom: 0.85rem;
}
.policy-list li {
    display: flex; align-items: flex-start; gap: 10px; line-height: 1.6;
}
.policy-list li::before {
    content: '→'; color: #6366f1; font-weight: 700;
    flex-shrink: 0; margin-top: 1px;
}
.policy-highlight {
    background: rgba(99,102,241,0.08);
    border: 1px solid rgba(99,102,241,0.2);
    border-radius: 10px; padding: 12px 16px;
    font-size: 0.85rem; color: #a5b4fc;
    display: flex; align-items: flex-start; gap: 10px;
    line-height: 1.6; margin-top: 1rem;
}
.policy-highlight i { margin-top: 2px; flex-shrink: 0; }
.policy-highlight strong { color: var(--text-primary); }
.policy-link { color: #a5b4fc; text-decoration: none; font-weight: 500; }
.policy-link:hover { color: white; }
</style>
@endpush