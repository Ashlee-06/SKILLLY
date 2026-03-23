<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CareerDomain;
use App\Models\Skill;
use App\Models\CareerSkillRule;

class CareerSkillRuleSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedBackendDeveloper();
        $this->seedFrontendDeveloper();
        $this->seedFullStackDeveloper();
        $this->seedQaEngineer();
        $this->seedAutomationTestEngineer();
        $this->seedMobileAppDeveloper();
        $this->seedDataAnalyst();
        $this->seedDataScientist();
        $this->seedMachineLearningEngineer();
        $this->seedAIEngineer();
        $this->seedBIDeveloper();
        $this->seedDevOpsEngineer();
        $this->seedCloudEngineer();
        $this->seedSiteReliabilityEngineer();
        $this->seedSystemAdministrator();
        $this->seedNetworkEngineer();
        $this->seedCybersecurityAnalyst();
        $this->seedSecurityEngineer();
        $this->seedEthicalHacker();           // ✅ FIX: removed duplicate call
        $this->seedInformationSecurityAnalyst();
        $this->seedProjectManager();
        $this->seedBusinessAnalyst();
        $this->seedTechnicalLead();
        $this->seedScrumMaster();
        $this->seedUIDesigner();
        $this->seedGraphicDesigner();
        $this->seedDigitalMarketingSpecialist();
        $this->seedMarketingManager();
        $this->seedSEOSpecialist();
        $this->seedContentStrategist();
        $this->seedAccountant();
        $this->seedFinancialAnalyst();
        $this->seedInvestmentAnalyst();
        $this->seedAuditor();
        $this->seedFinanceManager();
        $this->seedHRExecutive();
        $this->seedTalentAcquisitionSpecialist();
        $this->seedOperationsManager();
        $this->seedAdministrativeOfficer();
        $this->seedCustomerSuccessManager();
        $this->seedBlockchainDeveloper();
        $this->seedARVRDeveloper();
        $this->seedIoTEngineer();
    }

    // ─────────────────────────────────────────────────────────────
    // Shared helper — create/update a rule for one skill
    // ─────────────────────────────────────────────────────────────
    private function seedRule(CareerDomain $career, string $skillName, bool $mandatory, int $weight): void
    {
        $skill = Skill::where('skill_name', $skillName)->first();

        if (!$skill) {
            $this->command->warn("Skill not found: {$skillName}");
            return;
        }

        CareerSkillRule::updateOrCreate(
            [
                'career_domain_id' => $career->id,
                'skill_id'         => $skill->id,
            ],
            [
                'is_mandatory' => $mandatory,
                'weight'       => $weight,
            ]
        );
    }

    private function seedCareer(string $careerName, array $skills): void
    {
        $career = CareerDomain::where('career_name', $careerName)->first();

        if (!$career) {
            $this->command->warn("{$careerName} domain not found.");
            return;
        }

        foreach ($skills as $skillName => $config) {
            $this->seedRule($career, $skillName, $config['mandatory'], $config['weight']);

            // Seed alternative skills at same weight/mandatory level
            foreach ($config['alternatives'] ?? [] as $altName) {
                $this->seedRule($career, $altName, $config['mandatory'], $config['weight']);
            }
        }

        $this->command->info("{$careerName} rules seeded successfully.");
    }

    // ─────────────────────────────────────────────────────────────
    // Phase 1 – Software Development
    // ─────────────────────────────────────────────────────────────

    private function seedBackendDeveloper(): void
    {
        $this->seedCareer('Backend Developer', [
            'PHP'             => ['mandatory' => true,  'weight' => 5, 'alternatives' => ['Node.js', 'Python', 'Java']],
            'Laravel'         => ['mandatory' => true,  'weight' => 5, 'alternatives' => ['Django', 'Spring Boot', 'Express']],
            'MySQL'           => ['mandatory' => true,  'weight' => 5, 'alternatives' => ['PostgreSQL', 'MongoDB']],
            'REST API'        => ['mandatory' => true,  'weight' => 5, 'alternatives' => ['GraphQL']],
            'OOP'             => ['mandatory' => true,  'weight' => 5],
            'Git'             => ['mandatory' => true,  'weight' => 5],
            'Node.js'         => ['mandatory' => false, 'weight' => 2],
            'Express'         => ['mandatory' => false, 'weight' => 2],
            'Python'          => ['mandatory' => false, 'weight' => 2],
            'Django'          => ['mandatory' => false, 'weight' => 2],
            'Flask'           => ['mandatory' => false, 'weight' => 2],
            'Java'            => ['mandatory' => false, 'weight' => 2],
            'Spring Boot'     => ['mandatory' => false, 'weight' => 2],
            'PostgreSQL'      => ['mandatory' => false, 'weight' => 2],
            'MongoDB'         => ['mandatory' => false, 'weight' => 2],
            'Redis'           => ['mandatory' => false, 'weight' => 2],
            'Docker'          => ['mandatory' => false, 'weight' => 2],
            'Kubernetes'      => ['mandatory' => false, 'weight' => 2],
            'AWS'             => ['mandatory' => false, 'weight' => 2, 'alternatives' => ['Azure', 'GCP']],
            'Linux'           => ['mandatory' => false, 'weight' => 2],
            'CI/CD'           => ['mandatory' => false, 'weight' => 2],
            'GraphQL'         => ['mandatory' => false, 'weight' => 2],
            'JWT'             => ['mandatory' => false, 'weight' => 2, 'alternatives' => ['OAuth']],
            'OAuth'           => ['mandatory' => false, 'weight' => 2],
            'Microservices'   => ['mandatory' => false, 'weight' => 2],
            'gRPC'            => ['mandatory' => false, 'weight' => 2],
            'WebSockets'      => ['mandatory' => false, 'weight' => 2],
            'API Integration' => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedFrontendDeveloper(): void
    {
        $this->seedCareer('Frontend Developer', [
            'HTML'              => ['mandatory' => true,  'weight' => 5],
            'CSS'               => ['mandatory' => true,  'weight' => 5],
            'JavaScript'        => ['mandatory' => true,  'weight' => 5],
            'React'             => ['mandatory' => true,  'weight' => 5],
            'Git'               => ['mandatory' => true,  'weight' => 5],
            'Responsive Design' => ['mandatory' => true,  'weight' => 5],
            'TypeScript'        => ['mandatory' => false, 'weight' => 2],
            'Next.js'           => ['mandatory' => false, 'weight' => 2],
            'Vue.js'            => ['mandatory' => false, 'weight' => 2],
            'Bootstrap'         => ['mandatory' => false, 'weight' => 2],
            'Tailwind CSS'      => ['mandatory' => false, 'weight' => 2],
            'Webpack'           => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedFullStackDeveloper(): void
    {
        $this->seedCareer('Full Stack Developer', [
            'PHP'        => ['mandatory' => true,  'weight' => 5],
            'Laravel'    => ['mandatory' => true,  'weight' => 5],
            'MySQL'      => ['mandatory' => true,  'weight' => 5],
            'JavaScript' => ['mandatory' => true,  'weight' => 5],
            'React'      => ['mandatory' => true,  'weight' => 5],
            'HTML'       => ['mandatory' => true,  'weight' => 5],
            'CSS'        => ['mandatory' => true,  'weight' => 5],
            'REST API'   => ['mandatory' => false, 'weight' => 3],
            'Git'        => ['mandatory' => false, 'weight' => 3],
            'Node.js'    => ['mandatory' => false, 'weight' => 3],
            'Docker'     => ['mandatory' => false, 'weight' => 2],
            'AWS'        => ['mandatory' => false, 'weight' => 2],
            'TypeScript' => ['mandatory' => false, 'weight' => 2],
            'Next.js'    => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedQaEngineer(): void
    {
        $this->seedCareer('QA Engineer', [
            'Manual Testing'      => ['mandatory' => true,  'weight' => 5],
            'Test Cases'          => ['mandatory' => true,  'weight' => 5],
            'Bug Tracking'        => ['mandatory' => true,  'weight' => 5],
            'SDLC'                => ['mandatory' => true,  'weight' => 5],
            'STLC'                => ['mandatory' => true,  'weight' => 5],
            'Jira'                => ['mandatory' => false, 'weight' => 3],
            'Regression Testing'  => ['mandatory' => false, 'weight' => 3],
            'Functional Testing'  => ['mandatory' => false, 'weight' => 3],
            'API Testing'         => ['mandatory' => false, 'weight' => 3],
            'Selenium'            => ['mandatory' => false, 'weight' => 2],
            'Postman'             => ['mandatory' => false, 'weight' => 2],
            'Cypress'             => ['mandatory' => false, 'weight' => 2],
            'Test Documentation'  => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedAutomationTestEngineer(): void
    {
        $this->seedCareer('Automation Test Engineer', [
            'Selenium'           => ['mandatory' => true,  'weight' => 5],
            'Automation Testing' => ['mandatory' => true,  'weight' => 5],
            'TestNG'             => ['mandatory' => true,  'weight' => 5],
            'JUnit'              => ['mandatory' => true,  'weight' => 5],
            'Java'               => ['mandatory' => true,  'weight' => 5],
            'API Testing'        => ['mandatory' => false, 'weight' => 3],
            'Postman'            => ['mandatory' => false, 'weight' => 3],
            'Cypress'            => ['mandatory' => false, 'weight' => 3],
            'Regression Testing' => ['mandatory' => false, 'weight' => 3],
            'Git'                => ['mandatory' => false, 'weight' => 3],
            'Jenkins'            => ['mandatory' => false, 'weight' => 2],
            'CI/CD'              => ['mandatory' => false, 'weight' => 2],
            'Docker'             => ['mandatory' => false, 'weight' => 2],
            'Python'             => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedMobileAppDeveloper(): void
    {
        $this->seedCareer('Mobile App Developer', [
            'Java'               => ['mandatory' => true,  'weight' => 5],
            'Kotlin'             => ['mandatory' => true,  'weight' => 5],
            'Swift'              => ['mandatory' => true,  'weight' => 5],
            'Flutter'            => ['mandatory' => true,  'weight' => 5],
            'React Native'       => ['mandatory' => true,  'weight' => 5],
            'Android'            => ['mandatory' => false, 'weight' => 3],
            'iOS'                => ['mandatory' => false, 'weight' => 3],
            'REST API'           => ['mandatory' => false, 'weight' => 3],
            'Firebase'           => ['mandatory' => false, 'weight' => 3],
            'Git'                => ['mandatory' => false, 'weight' => 3],
            'Dart'               => ['mandatory' => false, 'weight' => 2],
            'Objective-C'        => ['mandatory' => false, 'weight' => 2],
            'SQLite'             => ['mandatory' => false, 'weight' => 2],
            'Push Notifications' => ['mandatory' => false, 'weight' => 2],
            'App Deployment'     => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    // Phase 2 – Data & AI
    // ─────────────────────────────────────────────────────────────

    private function seedDataAnalyst(): void
    {
        $this->seedCareer('Data Analyst', [
            'SQL'                => ['mandatory' => true,  'weight' => 5],
            'Excel'              => ['mandatory' => true,  'weight' => 5],
            'Data Visualization' => ['mandatory' => true,  'weight' => 4],
            'Statistics'         => ['mandatory' => true,  'weight' => 4],
            'Python'             => ['mandatory' => false, 'weight' => 3],
            'R'                  => ['mandatory' => false, 'weight' => 3],
            'Power BI'           => ['mandatory' => false, 'weight' => 2],
            'Tableau'            => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedDataScientist(): void
    {
        $this->seedCareer('Data Scientist', [
            'Python'           => ['mandatory' => true,  'weight' => 5],
            'Machine Learning' => ['mandatory' => true,  'weight' => 5],
            'Statistics'       => ['mandatory' => true,  'weight' => 5],
            'Data Wrangling'   => ['mandatory' => true,  'weight' => 4],
            'SQL'              => ['mandatory' => false, 'weight' => 4],
            'R'                => ['mandatory' => false, 'weight' => 3],
            'Deep Learning'    => ['mandatory' => false, 'weight' => 3],
            'Tableau'          => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedMachineLearningEngineer(): void
    {
        $this->seedCareer('Machine Learning Engineer', [
            'Python'           => ['mandatory' => true,  'weight' => 5],
            'Machine Learning' => ['mandatory' => true,  'weight' => 5],
            'Deep Learning'    => ['mandatory' => true,  'weight' => 5],
            'TensorFlow'       => ['mandatory' => true,  'weight' => 4],
            'PyTorch'          => ['mandatory' => false, 'weight' => 3],
            'SQL'              => ['mandatory' => false, 'weight' => 3],
            'Docker'           => ['mandatory' => false, 'weight' => 2],
            'AWS'              => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedAIEngineer(): void
    {
        $this->seedCareer('AI Engineer', [
            'Python'           => ['mandatory' => true,  'weight' => 5],
            'Machine Learning' => ['mandatory' => true,  'weight' => 5],
            'Deep Learning'    => ['mandatory' => true,  'weight' => 5],
            'NLP'              => ['mandatory' => true,  'weight' => 4],
            'Computer Vision'  => ['mandatory' => false, 'weight' => 4],
            'TensorFlow'       => ['mandatory' => false, 'weight' => 3],
            'PyTorch'          => ['mandatory' => false, 'weight' => 3],
            'AWS'              => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedBIDeveloper(): void
    {
        $this->seedCareer('Business Intelligence Developer', [
            'SQL'              => ['mandatory' => true,  'weight' => 5],
            'Data Warehousing' => ['mandatory' => true,  'weight' => 5],
            'Power BI'         => ['mandatory' => true,  'weight' => 4],
            'ETL'              => ['mandatory' => true,  'weight' => 4],
            'Python'           => ['mandatory' => false, 'weight' => 3],
            'Tableau'          => ['mandatory' => false, 'weight' => 3],
            'Excel'            => ['mandatory' => false, 'weight' => 2],
            'AWS'              => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    // Phase 3 – DevOps & Infrastructure
    // ─────────────────────────────────────────────────────────────

    private function seedDevOpsEngineer(): void
    {
        $this->seedCareer('DevOps Engineer', [
            'Linux'            => ['mandatory' => true,  'weight' => 5],
            'CI/CD'            => ['mandatory' => true,  'weight' => 5],
            'Docker'           => ['mandatory' => true,  'weight' => 5],
            'Kubernetes'       => ['mandatory' => true,  'weight' => 4],
            'Scripting'        => ['mandatory' => true,  'weight' => 4],
            'AWS'              => ['mandatory' => false, 'weight' => 3],
            'Azure'            => ['mandatory' => false, 'weight' => 3],
            'Terraform'        => ['mandatory' => false, 'weight' => 3],
            'Ansible'          => ['mandatory' => false, 'weight' => 2],
            'Monitoring Tools' => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedCloudEngineer(): void
    {
        $this->seedCareer('Cloud Engineer', [
            'AWS'                => ['mandatory' => true,  'weight' => 5],
            'Azure'              => ['mandatory' => true,  'weight' => 5],
            'Cloud Architecture' => ['mandatory' => true,  'weight' => 5],
            'Terraform'          => ['mandatory' => true,  'weight' => 4],
            'Scripting'          => ['mandatory' => true,  'weight' => 4],
            'Docker'             => ['mandatory' => false, 'weight' => 3],
            'Kubernetes'         => ['mandatory' => false, 'weight' => 3],
            'CI/CD'              => ['mandatory' => false, 'weight' => 2],
            'Monitoring Tools'   => ['mandatory' => false, 'weight' => 2],
            'Linux'              => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedSiteReliabilityEngineer(): void
    {
        $this->seedCareer('Site Reliability Engineer', [
            'Linux'            => ['mandatory' => true,  'weight' => 5],
            'Monitoring Tools' => ['mandatory' => true,  'weight' => 5],
            'CI/CD'            => ['mandatory' => true,  'weight' => 4],
            'Scripting'        => ['mandatory' => true,  'weight' => 4],
            'Cloud Platforms'  => ['mandatory' => true,  'weight' => 4],
            'Docker'           => ['mandatory' => false, 'weight' => 3],
            'Kubernetes'       => ['mandatory' => false, 'weight' => 3],
            'Terraform'        => ['mandatory' => false, 'weight' => 3],
            'AWS'              => ['mandatory' => false, 'weight' => 2],
            'Azure'            => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedSystemAdministrator(): void
    {
        $this->seedCareer('System Administrator', [
            'Linux'            => ['mandatory' => true,  'weight' => 5],
            'Windows Server'   => ['mandatory' => true,  'weight' => 5],
            'Networking'       => ['mandatory' => true,  'weight' => 4],
            'Scripting'        => ['mandatory' => true,  'weight' => 4],
            'Monitoring Tools' => ['mandatory' => true,  'weight' => 4],
            'Docker'           => ['mandatory' => false, 'weight' => 3],
            'AWS'              => ['mandatory' => false, 'weight' => 3],
            'CI/CD'            => ['mandatory' => false, 'weight' => 2],
            'Active Directory' => ['mandatory' => false, 'weight' => 2],
            'Backup & Recovery'=> ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedNetworkEngineer(): void
    {
        $this->seedCareer('Network Engineer', [
            'Networking'          => ['mandatory' => true,  'weight' => 5],
            'Routing & Switching' => ['mandatory' => true,  'weight' => 5],
            'Firewall Management' => ['mandatory' => true,  'weight' => 4],
            'VPN'                 => ['mandatory' => true,  'weight' => 4],
            'Monitoring Tools'    => ['mandatory' => true,  'weight' => 4],
            'Linux'               => ['mandatory' => false, 'weight' => 3],
            'AWS Networking'      => ['mandatory' => false, 'weight' => 3],
            'Cisco Devices'       => ['mandatory' => false, 'weight' => 3],
            'Network Security'    => ['mandatory' => false, 'weight' => 2],
            'Scripting'           => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    // Phase 4 – Cybersecurity
    // ─────────────────────────────────────────────────────────────

    private function seedCybersecurityAnalyst(): void
    {
        $this->seedCareer('Cybersecurity Analyst', [
            'Network Security'          => ['mandatory' => true,  'weight' => 5],
            'Vulnerability Assessment'  => ['mandatory' => true,  'weight' => 5],
            'Incident Response'         => ['mandatory' => true,  'weight' => 4],
            'SIEM Tools'                => ['mandatory' => true,  'weight' => 4],
            'Python'                    => ['mandatory' => false, 'weight' => 3],
            'Penetration Testing'       => ['mandatory' => false, 'weight' => 3],
            'Firewall Management'       => ['mandatory' => false, 'weight' => 2],
            'Cloud Security'            => ['mandatory' => false, 'weight' => 2],
            'Linux'                     => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedSecurityEngineer(): void
    {
        $this->seedCareer('Security Engineer', [
            'Network Security'     => ['mandatory' => true,  'weight' => 5],
            'Secure System Design' => ['mandatory' => true,  'weight' => 5],
            'Firewall Management'  => ['mandatory' => true,  'weight' => 4],
            'Encryption'           => ['mandatory' => true,  'weight' => 4],
            'Python'               => ['mandatory' => false, 'weight' => 3],
            'AWS Security'         => ['mandatory' => false, 'weight' => 3],
            'Cloud Security'       => ['mandatory' => false, 'weight' => 3],
            'Penetration Testing'  => ['mandatory' => false, 'weight' => 2],
            'Linux'                => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedEthicalHacker(): void
    {
        $this->seedCareer('Ethical Hacker', [
            'Penetration Testing'       => ['mandatory' => true,  'weight' => 5],
            'Network Security'          => ['mandatory' => true,  'weight' => 5],
            'Vulnerability Assessment'  => ['mandatory' => true,  'weight' => 4],
            'Scripting'                 => ['mandatory' => true,  'weight' => 4],
            'Python'                    => ['mandatory' => false, 'weight' => 3],
            'Linux'                     => ['mandatory' => false, 'weight' => 3],
            'Web Application Security'  => ['mandatory' => false, 'weight' => 3],
            'Social Engineering'        => ['mandatory' => false, 'weight' => 2],
            'Cloud Security'            => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedInformationSecurityAnalyst(): void
    {
        $this->seedCareer('Information Security Analyst', [
            'Risk Assessment'           => ['mandatory' => true,  'weight' => 5],
            'Compliance'                => ['mandatory' => true,  'weight' => 5],
            'Incident Response'         => ['mandatory' => true,  'weight' => 4],
            'Security Policies'         => ['mandatory' => true,  'weight' => 4],
            'Network Security'          => ['mandatory' => false, 'weight' => 3],
            'Vulnerability Assessment'  => ['mandatory' => false, 'weight' => 3],
            'Python'                    => ['mandatory' => false, 'weight' => 2],
            'SIEM Tools'                => ['mandatory' => false, 'weight' => 2],
            'Cloud Security'            => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    // Phase 5 – Product & Management
    // ─────────────────────────────────────────────────────────────

    private function seedProjectManager(): void
    {
        $this->seedCareer('Project Manager', [
            'Project Planning'       => ['mandatory' => true,  'weight' => 5],
            'Risk Management'        => ['mandatory' => true,  'weight' => 5],
            'Stakeholder Management' => ['mandatory' => true,  'weight' => 5],
            'Scheduling'             => ['mandatory' => true,  'weight' => 4],
            'Agile Methodologies'    => ['mandatory' => false, 'weight' => 4],
            'Communication'          => ['mandatory' => false, 'weight' => 3],
            'Budgeting'              => ['mandatory' => false, 'weight' => 3],
            'MS Project'             => ['mandatory' => false, 'weight' => 2],
            'Leadership'             => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedBusinessAnalyst(): void
    {
        $this->seedCareer('Business Analyst', [
            'Requirement Gathering'       => ['mandatory' => true,  'weight' => 5],
            'Business Analysis'           => ['mandatory' => true,  'weight' => 5],
            'Documentation'               => ['mandatory' => true,  'weight' => 4],
            'Stakeholder Communication'   => ['mandatory' => true,  'weight' => 4],
            'Agile Methodologies'         => ['mandatory' => false, 'weight' => 4],
            'Data Analysis'               => ['mandatory' => false, 'weight' => 3],
            'Process Modeling'            => ['mandatory' => false, 'weight' => 3],
            'MS Excel'                    => ['mandatory' => false, 'weight' => 2],
            'Presentation Skills'         => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedTechnicalLead(): void
    {
        $this->seedCareer('Technical Lead', [
            'Technical Architecture' => ['mandatory' => true,  'weight' => 5],
            'Code Review'            => ['mandatory' => true,  'weight' => 5],
            'Team Leadership'        => ['mandatory' => true,  'weight' => 4],
            'Project Planning'       => ['mandatory' => true,  'weight' => 4],
            'Agile Methodologies'    => ['mandatory' => false, 'weight' => 4],
            'Communication'          => ['mandatory' => false, 'weight' => 3],
            'Mentoring'              => ['mandatory' => false, 'weight' => 3],
            'DevOps Knowledge'       => ['mandatory' => false, 'weight' => 2],
            'Problem Solving'        => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedScrumMaster(): void
    {
        $this->seedCareer('Scrum Master', [
            'Agile Methodologies'    => ['mandatory' => true,  'weight' => 5],
            'Scrum Framework'        => ['mandatory' => true,  'weight' => 5],
            'Facilitation'           => ['mandatory' => true,  'weight' => 4],
            'Stakeholder Management' => ['mandatory' => true,  'weight' => 4],
            'Communication'          => ['mandatory' => false, 'weight' => 4],
            'Conflict Resolution'    => ['mandatory' => false, 'weight' => 3],
            'Coaching'               => ['mandatory' => false, 'weight' => 3],
            'Jira'                   => ['mandatory' => false, 'weight' => 2],
            'Leadership'             => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    // Phase 6 – Design
    // ─────────────────────────────────────────────────────────────

    private function seedUIDesigner(): void
    {
        $this->seedCareer('UI/UX Designer', [
            'UI Design'                  => ['mandatory' => true,  'weight' => 5],
            'UX Research'                => ['mandatory' => true,  'weight' => 5],
            'Wireframing & Prototyping'  => ['mandatory' => true,  'weight' => 4],
            'Design Thinking'            => ['mandatory' => true,  'weight' => 4],
            'Figma'                      => ['mandatory' => false, 'weight' => 4],
            'Adobe XD'                   => ['mandatory' => false, 'weight' => 3],
            'User Testing'               => ['mandatory' => false, 'weight' => 3],
            'Interaction Design'         => ['mandatory' => false, 'weight' => 2],
            'Communication'              => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedGraphicDesigner(): void
    {
        $this->seedCareer('Graphic Designer', [
            'Visual Design'     => ['mandatory' => true,  'weight' => 5],
            'Typography'        => ['mandatory' => true,  'weight' => 5],
            'Color Theory'      => ['mandatory' => true,  'weight' => 4],
            'Branding'          => ['mandatory' => true,  'weight' => 4],
            'Adobe Photoshop'   => ['mandatory' => false, 'weight' => 4],
            'Adobe Illustrator' => ['mandatory' => false, 'weight' => 4],
            'InDesign'          => ['mandatory' => false, 'weight' => 3],
            'Creativity'        => ['mandatory' => false, 'weight' => 3],
            'Communication'     => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    // Phase 7 – Marketing
    // ─────────────────────────────────────────────────────────────

    private function seedDigitalMarketingSpecialist(): void
    {
        $this->seedCareer('Digital Marketing Specialist', [
            'SEO'                   => ['mandatory' => true,  'weight' => 5],
            'SEM/PPC'               => ['mandatory' => true,  'weight' => 5],
            'Email Marketing'       => ['mandatory' => true,  'weight' => 4],
            'Analytics'             => ['mandatory' => true,  'weight' => 4],
            'Content Marketing'     => ['mandatory' => false, 'weight' => 3],
            'Social Media Marketing'=> ['mandatory' => false, 'weight' => 3],
            'Google Ads'            => ['mandatory' => false, 'weight' => 2],
            'Facebook Ads'          => ['mandatory' => false, 'weight' => 2],
            'Communication'         => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedMarketingManager(): void
    {
        $this->seedCareer('Marketing Manager', [
            'Marketing Strategy'     => ['mandatory' => true,  'weight' => 5],
            'Brand Management'       => ['mandatory' => true,  'weight' => 5],
            'Campaign Planning'      => ['mandatory' => true,  'weight' => 4],
            'Team Leadership'        => ['mandatory' => true,  'weight' => 4],
            'Digital Marketing'      => ['mandatory' => false, 'weight' => 4],
            'Analytics'              => ['mandatory' => false, 'weight' => 3],
            'SEO/SEM'                => ['mandatory' => false, 'weight' => 3],
            'Communication'          => ['mandatory' => false, 'weight' => 2],
            'Social Media Marketing' => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedSEOSpecialist(): void
    {
        $this->seedCareer('SEO Specialist', [
            'On-Page SEO'                 => ['mandatory' => true,  'weight' => 5],
            'Off-Page SEO'                => ['mandatory' => true,  'weight' => 5],
            'Keyword Research'            => ['mandatory' => true,  'weight' => 4],
            'Analytics'                   => ['mandatory' => true,  'weight' => 4],
            'Content Optimization'        => ['mandatory' => false, 'weight' => 3],
            'Technical SEO'               => ['mandatory' => false, 'weight' => 3],
            'Google Search Console'       => ['mandatory' => false, 'weight' => 2],
            'SEO Tools (Ahrefs/SEMRush)'  => ['mandatory' => false, 'weight' => 2],
            'Communication'               => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedContentStrategist(): void
    {
        $this->seedCareer('Content Strategist', [
            'Content Planning'                  => ['mandatory' => true,  'weight' => 5],
            'Content Creation'                  => ['mandatory' => true,  'weight' => 5],
            'SEO'                               => ['mandatory' => true,  'weight' => 4],
            'Analytics'                         => ['mandatory' => true,  'weight' => 4],
            'Social Media Marketing'            => ['mandatory' => false, 'weight' => 3],
            'Copywriting'                       => ['mandatory' => false, 'weight' => 3],
            'Email Marketing'                   => ['mandatory' => false, 'weight' => 2],
            'Content Management Systems (CMS)'  => ['mandatory' => false, 'weight' => 2],
            'Communication'                     => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    // Phase 8 – Finance
    // ─────────────────────────────────────────────────────────────

    private function seedAccountant(): void
    {
        $this->seedCareer('Accountant', [
            'Financial Reporting'   => ['mandatory' => true,  'weight' => 5],
            'Bookkeeping'           => ['mandatory' => true,  'weight' => 5],
            'Accounting Principles' => ['mandatory' => true,  'weight' => 4],
            'Taxation'              => ['mandatory' => true,  'weight' => 4],
            'MS Excel'              => ['mandatory' => false, 'weight' => 4],
            'ERP Systems'           => ['mandatory' => false, 'weight' => 3],
            'Auditing Basics'       => ['mandatory' => false, 'weight' => 3],
            'Communication'         => ['mandatory' => false, 'weight' => 2],
            'Time Management'       => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedFinancialAnalyst(): void
    {
        $this->seedCareer('Financial Analyst', [
            'Financial Modeling'    => ['mandatory' => true,  'weight' => 5],
            'Data Analysis'         => ['mandatory' => true,  'weight' => 5],
            'Forecasting'           => ['mandatory' => true,  'weight' => 4],
            'Excel/Spreadsheets'    => ['mandatory' => true,  'weight' => 4],
            'Accounting Principles' => ['mandatory' => false, 'weight' => 3],
            'Presentation Skills'   => ['mandatory' => false, 'weight' => 3],
            'ERP Systems'           => ['mandatory' => false, 'weight' => 2],
            'SQL'                   => ['mandatory' => false, 'weight' => 2],
            'Communication'         => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedInvestmentAnalyst(): void
    {
        $this->seedCareer('Investment Analyst', [
            'Financial Analysis'    => ['mandatory' => true,  'weight' => 5],
            'Valuation'             => ['mandatory' => true,  'weight' => 5],
            'Investment Research'   => ['mandatory' => true,  'weight' => 4],
            'Portfolio Management'  => ['mandatory' => true,  'weight' => 4],
            'Excel/Spreadsheets'    => ['mandatory' => false, 'weight' => 3],
            'Accounting Principles' => ['mandatory' => false, 'weight' => 3],
            'Financial Modeling'    => ['mandatory' => false, 'weight' => 2],
            'Communication'         => ['mandatory' => false, 'weight' => 2],
            'Presentation Skills'   => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedAuditor(): void
    {
        $this->seedCareer('Auditor', [
            'Audit Planning'      => ['mandatory' => true,  'weight' => 5],
            'Financial Reporting' => ['mandatory' => true,  'weight' => 5],
            'Compliance'          => ['mandatory' => true,  'weight' => 4],
            'Internal Controls'   => ['mandatory' => true,  'weight' => 4],
            'Risk Assessment'     => ['mandatory' => false, 'weight' => 3],
            'ERP Systems'         => ['mandatory' => false, 'weight' => 3],
            'MS Excel'            => ['mandatory' => false, 'weight' => 2],
            'Communication'       => ['mandatory' => false, 'weight' => 2],
            'Attention to Detail' => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedFinanceManager(): void
    {
        $this->seedCareer('Finance Manager', [
            'Financial Planning'    => ['mandatory' => true,  'weight' => 5],
            'Budgeting'             => ['mandatory' => true,  'weight' => 5],
            'Forecasting'           => ['mandatory' => true,  'weight' => 4],
            'Team Leadership'       => ['mandatory' => true,  'weight' => 4],
            'Risk Management'       => ['mandatory' => false, 'weight' => 3],
            'ERP Systems'           => ['mandatory' => false, 'weight' => 3],
            'Accounting Principles' => ['mandatory' => false, 'weight' => 2],
            'Communication'         => ['mandatory' => false, 'weight' => 2],
            'Decision Making'       => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    // Phase 9 – HR & Operations
    // ─────────────────────────────────────────────────────────────

    private function seedHRExecutive(): void
    {
        $this->seedCareer('HR Executive', [
            'Recruitment'            => ['mandatory' => true,  'weight' => 5],
            'Employee Relations'     => ['mandatory' => true,  'weight' => 5],
            'HR Policies'            => ['mandatory' => true,  'weight' => 4],
            'Onboarding'             => ['mandatory' => true,  'weight' => 4],
            'HR Software (HRMS)'     => ['mandatory' => false, 'weight' => 3],
            'Communication'          => ['mandatory' => false, 'weight' => 3],
            'Conflict Resolution'    => ['mandatory' => false, 'weight' => 2],
            'Time Management'        => ['mandatory' => false, 'weight' => 2],
            'Training & Development' => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedTalentAcquisitionSpecialist(): void
    {
        $this->seedCareer('Talent Acquisition Specialist', [
            'Recruitment Strategy' => ['mandatory' => true,  'weight' => 5],
            'Candidate Sourcing'   => ['mandatory' => true,  'weight' => 5],
            'Interviewing'         => ['mandatory' => true,  'weight' => 4],
            'Onboarding'           => ['mandatory' => true,  'weight' => 4],
            'Employer Branding'    => ['mandatory' => false, 'weight' => 3],
            'HR Software (ATS)'    => ['mandatory' => false, 'weight' => 3],
            'Communication'        => ['mandatory' => false, 'weight' => 2],
            'Negotiation Skills'   => ['mandatory' => false, 'weight' => 2],
            'Networking'           => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedOperationsManager(): void
    {
        $this->seedCareer('Operations Manager', [
            'Process Management'   => ['mandatory' => true,  'weight' => 5],
            'Operational Planning' => ['mandatory' => true,  'weight' => 5],
            'Team Leadership'      => ['mandatory' => true,  'weight' => 4],
            'Problem Solving'      => ['mandatory' => true,  'weight' => 4],
            'Project Management'   => ['mandatory' => false, 'weight' => 3],
            'ERP Systems'          => ['mandatory' => false, 'weight' => 3],
            'Communication'        => ['mandatory' => false, 'weight' => 2],
            'Time Management'      => ['mandatory' => false, 'weight' => 2],
            'Analytics'            => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedAdministrativeOfficer(): void
    {
        $this->seedCareer('Administrative Officer', [
            'Office Management' => ['mandatory' => true,  'weight' => 5],
            'Documentation'     => ['mandatory' => true,  'weight' => 5],
            'Scheduling'        => ['mandatory' => true,  'weight' => 4],
            'Communication'     => ['mandatory' => true,  'weight' => 4],
            'MS Office'         => ['mandatory' => false, 'weight' => 3],
            'Record Keeping'    => ['mandatory' => false, 'weight' => 3],
            'Time Management'   => ['mandatory' => false, 'weight' => 2],
            'Problem Solving'   => ['mandatory' => false, 'weight' => 2],
            'Customer Service'  => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedCustomerSuccessManager(): void
    {
        $this->seedCareer('Customer Success Manager', [
            'Client Relationship Management' => ['mandatory' => true,  'weight' => 5],
            'Communication'                  => ['mandatory' => true,  'weight' => 5],
            'Problem Solving'                => ['mandatory' => true,  'weight' => 4],
            'Customer Retention'             => ['mandatory' => true,  'weight' => 4],
            'CRM Software'                   => ['mandatory' => false, 'weight' => 3],
            'Analytics'                      => ['mandatory' => false, 'weight' => 3],
            'Negotiation'                    => ['mandatory' => false, 'weight' => 2],
            'Time Management'                => ['mandatory' => false, 'weight' => 2],
            'Team Collaboration'             => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    // Phase 10 – Emerging Technologies
    // ─────────────────────────────────────────────────────────────

    private function seedBlockchainDeveloper(): void
    {
        $this->seedCareer('Blockchain Developer', [
            'Solidity'               => ['mandatory' => true,  'weight' => 5],
            'Smart Contracts'        => ['mandatory' => true,  'weight' => 5],
            'Ethereum'               => ['mandatory' => true,  'weight' => 4],
            'Cryptography'           => ['mandatory' => true,  'weight' => 4],
            'Web3.js'                => ['mandatory' => false, 'weight' => 3],
            'Blockchain Architecture'=> ['mandatory' => false, 'weight' => 3],
            'Node.js'                => ['mandatory' => false, 'weight' => 2],
            'APIs'                   => ['mandatory' => false, 'weight' => 2],
            'Problem Solving'        => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedARVRDeveloper(): void
    {
        $this->seedCareer('AR/VR Developer', [
            'Unity3D'                => ['mandatory' => true,  'weight' => 5],
            'Unreal Engine'          => ['mandatory' => true,  'weight' => 5],
            '3D Modeling'            => ['mandatory' => true,  'weight' => 4],
            'C# / C++ Programming'   => ['mandatory' => true,  'weight' => 4],
            'ARKit / ARCore'         => ['mandatory' => false, 'weight' => 3],
            'VR Hardware Integration'=> ['mandatory' => false, 'weight' => 3],
            'Shaders & Graphics'     => ['mandatory' => false, 'weight' => 2],
            'UX for AR/VR'           => ['mandatory' => false, 'weight' => 2],
            'Problem Solving'        => ['mandatory' => false, 'weight' => 2],
        ]);
    }

    private function seedIoTEngineer(): void
    {
        $this->seedCareer('IoT Engineer', [
            'Embedded Systems'                        => ['mandatory' => true,  'weight' => 5],
            'IoT Protocols (MQTT, CoAP)'              => ['mandatory' => true,  'weight' => 5],
            'Sensor Integration'                      => ['mandatory' => true,  'weight' => 4],
            'Microcontrollers (Arduino/Raspberry Pi)' => ['mandatory' => true,  'weight' => 4],
            'Cloud IoT Platforms'                     => ['mandatory' => false, 'weight' => 3],
            'Networking'                              => ['mandatory' => false, 'weight' => 3],
            'Data Analytics'                          => ['mandatory' => false, 'weight' => 2],
            'Programming (Python/C)'                  => ['mandatory' => false, 'weight' => 2],
            'Problem Solving'                         => ['mandatory' => false, 'weight' => 2],
        ]);
    }
}