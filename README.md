# Eduleb — Online Learning Management Platform

Eduleb is a Laravel-based educational platform designed to connect students and instructors through an online learning experience. It brings course discovery, enrollment, learning dashboards, instructor tools, and educational content management into one application.

> **Project status:** In development.

## Overview

Eduleb provides a public learning website alongside role-based areas for administrators, instructors, and students. The application is built with Laravel and PHP, with a relational database and server-rendered Blade views.

## Features

### Public website
- Browse published courses and view course details.
- Explore instructor profiles.
- Read blog posts and comments.
- Browse frequently asked questions.
- View pricing information and submit contact messages.

### Student experience
- Student dashboard with learning-related information.
- View enrolled courses and course lessons.
- Submit course reviews.
- Receive application and course-related notifications.
- Enroll in courses through a Stripe Checkout flow.
- Request cancellation/refund through the available enrollment flow.

### Instructor experience
- Instructor dashboard.
- View courses and enrolled students.
- Review student feedback.
- Manage lessons for instructor courses, including recorded and live lecture content.

### Administration
- Role-based access for administrators, instructors, and students.
- Manage courses, users, blog posts, FAQs, and applications.
- Application review workflows for instructor-related requests.

### Account and integrations
- Registration, login, password reset, and email verification.
- Google OAuth sign-in (requires Google credentials).
- Role and permission management.
- Stripe payment integration (requires Stripe credentials).

## Technology stack

- **Backend:** PHP 8.3+, Laravel 13
- **Database:** MySQL or SQLite (depending on local configuration)
- **Frontend:** Laravel Blade, HTML, CSS, Tailwind CSS, JavaScript
- **Authentication:** Laravel authentication and Google OAuth via Laravel Socialite
- **Authorization:** Spatie Laravel Permission
- **Payments:** Stripe Checkout and refunds
- **Notifications:** Laravel database notifications

## Getting started

### Requirements

- PHP 8.3 or later
- Composer
- MySQL or SQLite
- A web server or PHP's built-in development server

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/ahmed72ayyad-beep/Eduleb.git
   cd Eduleb
   ```

2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Create your environment file:

   **Windows (PowerShell):**
   ```powershell
   Copy-Item .env.example .env
   ```

   **macOS / Linux:**
   ```bash
   cp .env.example .env
   ```

4. Generate the application key:

   ```bash
   php artisan key:generate
   ```

5. Configure your database connection in `.env`. For MySQL, set the following values to match your local database:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=eduleb
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   Create the database before running migrations. Alternatively, configure SQLite in `.env`.

6. Run database migrations:

   ```bash
   php artisan migrate
   ```

7. Start the local development server:

   ```bash
   php artisan serve
   ```

   Open the local URL shown in your terminal (usually http://127.0.0.1:8000).

## Optional integrations

The following integrations need credentials before their features can be used:

- **Google sign-in:** configure `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, and `GOOGLE_REDIRECT_URI` in `.env`.
- **Stripe payments and refunds:** add your Stripe secret key as `STRIPE_SECRET` in `.env`, and configure the corresponding Stripe account settings.

Never commit your real `.env` file, API keys, passwords, or other secrets. Use `.env.example` as the safe configuration template.

## Project structure

The application follows Laravel's standard structure:

- `app/Models` — Eloquent models and relationships.
- `app/Http/Controllers` — application controllers and request handling.
- `app/Policies` — authorization policies.
- `database/migrations` — database schema history.
- `resources/views` — Blade templates for public pages and dashboards.
- `routes/web.php` — web routes.
- `tests` — automated tests.

## Screenshots

Screenshots of the public website and role-based dashboards will be added here.

## Notes

- Eduleb is an ongoing project; features and setup requirements may change as development continues.
- Payment and OAuth features require valid provider credentials and should be tested in their respective sandbox/development environments before production use.
- Do not use production payment credentials or real customer data in a local development environment.

## Repository

[github.com/ahmed72ayyad-beep/Eduleb](https://github.com/ahmed72ayyad-beep/Eduleb)
