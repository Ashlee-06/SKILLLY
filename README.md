# Skillly — Resume Assistance & Career Guidance Bot

A web-based career guidance application that analyses uploaded resumes, extracts skills, recommends career paths, and delivers personalised guidance through an interactive chatbot interface.

---

## Overview

Skillly accepts a resume in PDF, DOC, or DOCX format and runs it through a rule-based skill extraction and career matching engine. Results are presented through a conversational chatbot UI with a readiness score, matched skills, skill gaps, and a downloadable PDF report. Registered users can save and revisit past analyses from a history dashboard.

---

## Features

- Resume upload — PDF, DOC, DOCX support up to 5 MB
- Keyword-based skill extraction across ~200 predefined technical and soft skills
- Weighted career recommendation engine scoring against 45 career paths
- Interactive rule-based chatbot with quick-reply buttons and free-text input
- Readiness score displayed consistently across the score card, chat, and PDF report
- Downloadable PDF career report including alternative career matches and action plan
- User authentication — register, login, password reset via email
- Persistent analysis history for registered users with chat replay and report re-download
- Full guest access — no account required to use the core analysis feature
- Custom delete modal and download toast notifications

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.1+, Laravel 10 |
| Authentication | Laravel Breeze (Blade) |
| Frontend | HTML5, CSS3, Bootstrap 5, Vanilla JavaScript |
| Database | MySQL 8.0+ |
| PDF Parser | smalot/pdfparser |
| Word Parser | phpoffice/phpword |
| PDF Generator | barryvdh/laravel-dompdf |
| Email | Laravel Mail + SMTP |
| Web Server | Apache with mod_rewrite |

---

## Requirements

- PHP 8.1+
- Composer 2.x
- MySQL 8.0+
- Node.js 18+ and npm
- Apache with mod_rewrite enabled

---

## Installation

**1. Clone the repository**

```bash
git clone https://github.com/ashleedasilva06/Resume-Assistance-Career-Guidance-Bot.git
cd Resume-Assistance-Career-Guidance-Bot
```

**2. Install PHP dependencies**

```bash
composer install
```

**3. Install and build frontend assets**

```bash
npm install && npm run build
```

**4. Configure environment**

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your database credentials, app URL, and mail settings.

**5. Run migrations and seed the database**

```bash
php artisan migrate
php artisan db:seed
```

**6. Link storage and set permissions**

```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

**7. Start the development server**

```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser.

---

## Environment Variables

The following `.env` variables are required:

```env
APP_NAME=Skillly
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=skillly_db
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your@gmail.com
MAIL_FROM_NAME="Skillly"

FILESYSTEM_DISK=local
```

For local testing without a mail server, set `MAIL_MAILER=log` — password reset links will appear in `storage/logs/laravel.log`.

---

## Database Seeding

The application requires three seeders to be run in order:

```bash
php artisan db:seed --class=SkillSeeder          # ~200 skills
php artisan db:seed --class=CareerDomainSeeder   # 45 career paths
php artisan db:seed --class=CareerSkillRuleSeeder # skill-to-career rules
```

Or run all at once:

```bash
php artisan db:seed
```

---

## Project Structure

```
app/
├── Http/Controllers/
│   ├── ResumeController.php       # Upload, chat, report download
│   └── HistoryController.php      # Saved analysis history
├── Models/
│   ├── User.php
│   ├── Resume.php
│   ├── Skill.php
│   ├── CareerDomain.php
│   ├── CareerSkillRule.php
│   ├── ResumeSkill.php
│   └── ChatSession.php
└── Services/
    ├── Resume/
    │   ├── ResumeParserService.php
    │   └── SkillExtractionService.php
    ├── Career/
    │   └── CareerRecommendationService.php
    └── Bot/
        └── ChatbotService.php

resources/views/
├── layouts/app.blade.php
├── resume/
│   ├── upload.blade.php
│   ├── chat.blade.php
│   └── report.blade.php
├── history/
│   ├── index.blade.php
│   └── show.blade.php
└── auth/
    ├── login.blade.php
    ├── register.blade.php
    ├── forgot-password.blade.php
    └── reset-password.blade.php
```

---

## How It Works

1. User uploads a resume — PDF, DOC, or DOCX
2. Text is extracted from all elements including tables and bullet lists
3. Skill extraction engine matches text against ~200 predefined keyword patterns
4. Career recommendation engine scores every career domain using weighted rules
5. Top match and alternatives are ranked by weighted percentage
6. Chatbot generates an initial analysis conversation
7. User interacts with the chatbot for deeper guidance
8. PDF report is generated on demand including all matched skills, gaps, and alternatives
9. Registered users have all results saved automatically to their history

---

## Deployment

See the [Deployment Checklist](docs/Deployment_Checklist.md) for full production setup instructions including Apache configuration, environment setup, and post-deployment checks.

For quick deployment on Railway (no credit card required):

1. Push this repository to GitHub
2. Connect the repo at [railway.app](https://railway.app)
3. Add a MySQL database service
4. Set all environment variables in the Railway dashboard
5. Set the start command:

```bash
php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

---

## Documentation

| Document | Description |
|---|---|
| SRS | Software Requirements Specification |
| Technical Specification | Architecture, stack, and implementation details |
| ERD Documentation | Database schema and entity relationships |
| Deployment Checklist | Step-by-step production deployment guide |
| Unit Test Cases | 47 test cases across all service classes |
| User Guide | End-user instructions for the application |

---

## License

This project was developed as an academic internship project. All rights reserved.

---

*Prepared by Ashlee Da Silva — March 2026*