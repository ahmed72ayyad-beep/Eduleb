@extends('layouts.website')

@section('title', 'Apply to Teach | Eduleb')

@section('CSS')
    <style>
        .instructor-apply {
            --apply-ink: #1a2d62;
            --apply-blue: #525fe1;
            --apply-muted: #697386;
            --apply-border: #e8eaf3;
            background: #f6f7fc;
            color: var(--apply-ink);
        }

        .instructor-apply .apply-hero {
            position: relative;
            overflow: hidden;
            padding: 145px 0 76px;
            background:
                radial-gradient(circle at 85% 20%, rgba(255, 255, 255, .13), transparent 25%),
                linear-gradient(110deg, #172653 0%, #303d9d 58%, #525fe1 100%);
        }

        .apply-hero__eyebrow {
            margin-bottom: 14px;
            color: #cbd2ff;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .apply-hero__title {
            max-width: 720px;
            margin: 0 0 16px;
            color: #fff;
            font-size: clamp(38px, 5vw, 58px);
            font-weight: 700;
            line-height: 1.1;
        }

        .apply-hero__description {
            max-width: 650px;
            margin: 0;
            color: #e0e6ff;
            font-size: 17px;
            line-height: 1.7;
        }

        .apply-hero__action {
            text-align: right;
        }

        .instructor-apply .apply-hero__link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            padding: 12px 20px;
            border: 1px solid rgba(255, 255, 255, .7);
            border-radius: 6px;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: color .2s ease, background .2s ease, transform .2s ease;
        }

        .instructor-apply .apply-hero__link:hover {
            transform: translateY(-2px);
            background: #fff;
            color: var(--apply-ink);
        }

        .apply-main {
            padding-top: 68px;
            padding-bottom: 84px;
        }

        .apply-form-card,
        .apply-aside-card {
            overflow: hidden;
            border: 1px solid var(--apply-border);
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 12px 35px rgba(26, 45, 98, .07);
        }

        .apply-form-card {
            padding: 36px;
        }

        .apply-form-card__header {
            margin-bottom: 28px;
            padding-bottom: 22px;
            border-bottom: 1px solid #eef0f6;
        }

        .apply-form-card__eyebrow {
            margin-bottom: 8px;
            color: var(--apply-blue);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .apply-form-card__title {
            margin: 0 0 8px;
            color: var(--apply-ink);
            font-size: 27px;
            font-weight: 700;
        }

        .apply-form-card__description {
            margin: 0;
            color: var(--apply-muted);
        }

        .instructor-apply label.apply-label {
            display: block;
            margin-bottom: 8px;
            color: #28304e;
            font-size: 14px;
            font-weight: 600;
            text-transform: none;
        }

        .instructor-apply .apply-field {
            width: 100%;
            min-height: 50px;
            border: 1px solid #d9deea !important;
            border-radius: 6px;
            box-shadow: none;
            color: #20243a;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .instructor-apply textarea.apply-field {
            min-height: 142px;
            resize: vertical;
        }

        .instructor-apply input[type="file"].apply-field {
            height: auto;
            padding: 10px 12px;
        }

        .instructor-apply .apply-field:focus {
            border-color: var(--apply-blue) !important;
            box-shadow: 0 0 0 3px rgb(82 95 225 / 13%);
        }

        .instructor-apply .spicialmsg {
            display: block;
            margin-top: 4px;
            color: var(--apply-muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .instructor-apply .apply-field + p[style*="color: red"] {
            margin-top: 6px !important;
            color: #b42318 !important;
            font-size: 13px !important;
        }

        .apply-help {
            margin: 8px 0 0;
            color: var(--apply-muted);
            font-size: 13px;
            line-height: 1.5;
        }

        .apply-notice {
            margin-top: 26px;
            padding: 14px 16px;
            border: 1px solid #f4dfb2;
            border-radius: 6px;
            background: #fff9eb;
            color: #735313;
            font-size: 13px;
            line-height: 1.6;
        }

        .apply-notice strong {
            color: #5e420b;
        }

        .instructor-apply .apply-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            min-height: 50px;
            padding: 0 24px;
            border: 0;
            border-radius: 6px;
            background: var(--apply-blue);
            color: #fff;
            font-weight: 700;
            transition: background .2s ease, box-shadow .2s ease, transform .2s ease;
        }

        .instructor-apply .apply-submit:hover {
            transform: translateY(-2px);
            background: #414dd0;
            box-shadow: 0 8px 18px rgba(82, 95, 225, .24);
        }

        .apply-form-card__footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-top: 24px;
            padding-top: 22px;
            border-top: 1px solid #eef0f6;
        }

        .apply-form-card__footer p {
            margin: 0;
            color: var(--apply-muted);
            font-size: 13px;
            line-height: 1.5;
        }

        .apply-aside-sticky {
            position: sticky;
            top: 110px;
        }

        .apply-aside-card__image {
            display: block;
            width: 100%;
            aspect-ratio: 16 / 9;
            object-fit: cover;
        }

        .apply-aside-card__body {
            padding: 26px;
        }

        .apply-aside-card__meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
        }

        .apply-program-badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 999px;
            background: #eef0ff;
            color: var(--apply-blue);
            font-size: 12px;
            font-weight: 700;
        }

        .apply-aside-card__meta-note {
            color: var(--apply-muted);
            font-size: 12px;
        }

        .apply-aside-card__title {
            margin: 0 0 8px;
            color: var(--apply-ink);
            font-size: 21px;
            font-weight: 700;
        }

        .apply-aside-card__intro {
            margin: 0 0 16px;
            color: var(--apply-muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .apply-steps {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .apply-step {
            display: flex;
            gap: 14px;
            padding: 17px 0;
            border-top: 1px solid #eef0f6;
        }

        .apply-step__number {
            display: flex;
            flex: 0 0 34px;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #eef0ff;
            color: var(--apply-blue);
            font-size: 14px;
            font-weight: 700;
        }

        .apply-step:first-child .apply-step__number {
            background: var(--apply-ink);
            color: #fff;
        }

        .apply-step__title {
            margin: 0 0 5px;
            color: var(--apply-ink);
            font-size: 15px;
            font-weight: 700;
        }

        .apply-step__description {
            margin: 0;
            color: var(--apply-muted);
            font-size: 13px;
            line-height: 1.55;
        }

        .apply-status-callout {
            margin-top: 18px;
            padding: 16px;
            border-radius: 8px;
            background: #f6f7fc;
        }

        .apply-status-callout__title {
            margin: 0 0 5px;
            color: var(--apply-ink);
            font-size: 13px;
            font-weight: 700;
        }

        .apply-status-callout a {
            color: var(--apply-blue);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
        }

        .apply-status-callout a:hover {
            text-decoration: underline;
        }

        @media (max-width: 991.98px) {
            .instructor-apply .apply-hero {
                padding: 130px 0 62px;
            }

            .apply-hero__action {
                text-align: left;
            }

            .apply-main {
                padding-top: 48px;
                padding-bottom: 60px;
            }

            .apply-aside-sticky {
                position: static;
            }
        }

        @media (max-width: 575.98px) {
            .instructor-apply .apply-hero {
                padding: 118px 0 48px;
            }

            .apply-hero__description {
                font-size: 15px;
            }

            .apply-form-card {
                padding: 24px 18px;
            }

            .apply-form-card__title {
                font-size: 23px;
            }

            .apply-form-card__footer {
                align-items: stretch;
                flex-direction: column;
            }

            .apply-form-card__footer .apply-submit {
                width: 100%;
            }

            .apply-aside-card__body {
                padding: 22px 18px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .instructor-apply * {
                transition-duration: .01ms !important;
            }
        }
    </style>
@endsection

@section('content')
    <main class="instructor-apply">
        <section class="apply-hero text-white">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <p class="apply-hero__eyebrow">Teach with Eduleb</p>
                        <h1 class="apply-hero__title">Share what you know.</h1>
                        <p class="apply-hero__description">Introduce your experience and the subjects you care about. Your
                            profile details help learners find the right guide.</p>
                    </div>
                    <div class="col-lg-4 apply-hero__action">
                        <a href="{{ route('student.applications.index') }}" class="apply-hero__link">
                            View my applications
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="container apply-main">
            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <form enctype="multipart/form-data" id="instructor-application-form"
                        action="{{ route('student.applications.store') }}" method="POST" class="apply-form-card" novalidate>
                        @csrf
                        <div class="apply-form-card__header">
                            <p class="apply-form-card__eyebrow">Instructor application</p>
                            <h2 class="apply-form-card__title">Your teaching profile</h2>
                            <p class="apply-form-card__description">Complete the details below to prepare your application.</p>
                        </div>
                        <input type="hidden" name="type" value="instructor_application">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <x-input labelclass="apply-label" id="applicant-major" label="Area of expertise"
                                    class="form-control apply-field" id="applicant-major" name="major"
                                    placeholder="e.g. Product design" required />
                            </div>
                            <div class="col-md-6">
                                <x-input labelclass="apply-label" id="job-title" label="Professional title"
                                    class="form-control apply-field" id="job-title" name="job_title"
                                    placeholder="Professor,Doctor,PhD candidate,Industry professional,Other.." required />
                            </div>
                            <div class="col-md-6">
                                <x-input labelclass="apply-label" label="Phone number" class="form-control apply-field"
                                    id="applicant-phone" name="phone" type="tel" placeholder="+961 00 000 000"
                                    required />
                            </div>
                            <div class="col-md-6">
                                <x-input labelclass="apply-label" label="Portfolio or website"
                                    class="form-control apply-field" id="applicant-portfolio" name="portfolio_link"
                                    type="url" placeholder="https://yourportfolio.com" />
                            </div>
                            <div class="col-12">
                                <x-textarea labelclass="apply-label" label="About your teaching experienc"
                                    class="form-control apply-field" id="applicant-bio" name="description" rows="5"
                                    placeholder="Tell learners about your background, teaching approach, and the skills you can help them build."
                                    required />
                            </div>
                            <div class="col-12">
                                <x-input labelclass="apply-label" label="Profile photo" class="form-control apply-field"
                                    id="applicant-image" name="personal_image" type="file" accept="image/png,image/jpeg"
                                    spicialmsg="Leave This Field If You Want To keep You image" spicialmsgclass="spicialmsg" />
                                <p class="mt-2 mb-0 small text-muted">PNG or JPG. A clear, friendly headshot works best.</p>
                            </div>
                            <div class="col-12">
                                <x-input labelclass="apply-label" id="applicant-cv" label="Your CV"
                                    class="form-control apply-field" id="applicant-cv" name="CV" type="file" accept="PDF"
                                    spicialmsg="Sould be in english with max size 10m" spicialmsgclass="spicialmsg" />
                                <p class="mt-2 mb-0 small text-muted">PDF A clear, Pref and orgnaize CV.</p>
                            </div>
                        </div>

                        <div id="application-message" class="alert alert-success mt-4 d-none" role="status"></div>
                        <div class="apply-notice" role="note">
                            <strong>Please review your details.</strong> Incomplete or incorrect information may result in
                            your application being declined.
                        </div>
                        <div class="apply-form-card__footer">
                            <p>Your profile information helps learners find the right instructor.</p>
                            <button class="apply-submit" type="submit">
                                Send application <span aria-hidden="true">→</span>
                            </button>
                        </div>
                    </form>
                </div>

                <aside class="col-lg-4">
                    <div class="apply-aside-sticky">
                        <div class="apply-aside-card">
                            <img class="apply-aside-card__image" src="{{ asset('assets/img/wellcome.png') }}"
                                alt="Learners studying together">

                            <div class="apply-aside-card__body">
                                <div class="apply-aside-card__meta">
                                    <span class="apply-program-badge">Instructor program</span>
                                    <span class="apply-aside-card__meta-note">Quick steps</span>
                                </div>

                                <h2 class="apply-aside-card__title">Become an Eduleb instructor</h2>
                                <p class="apply-aside-card__intro">A few details are all it takes to introduce yourself to
                                    learners.</p>

                                <ol class="apply-steps">
                                    <li class="apply-step">
                                        <span class="apply-step__number">1</span>
                                        <div>
                                            <h3 class="apply-step__title">Add your expertise</h3>
                                            <p class="apply-step__description">Choose a clear subject area and professional
                                                title.</p>
                                        </div>
                                    </li>

                                    <li class="apply-step">
                                        <span class="apply-step__number">2</span>
                                        <div>
                                            <h3 class="apply-step__title">Describe your approach</h3>
                                            <p class="apply-step__description">Show how you teach and what learners can
                                                expect.</p>
                                        </div>
                                    </li>

                                    <li class="apply-step">
                                        <span class="apply-step__number">3</span>
                                        <div>
                                            <h3 class="apply-step__title">Keep it ready</h3>
                                            <p class="apply-step__description">Your preview remains available in the
                                                applications area.</p>
                                        </div>
                                    </li>
                                </ol>

                                <div class="apply-status-callout">
                                    <p class="apply-status-callout__title">Need to leave?</p>
                                    <a
                                        href="{{ route('student.applications.index') }}">
                                        Return to application status <span aria-hidden="true">→</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </main>
@endsection

{{-- @section('JS')
    <script>
        (() => {
            const form = document.querySelector('#instructor-application-form');
            const message = document.querySelector('#application-message');
            const storageKey = 'edulebInstructorApplications';

            form.addEventListener('submit', (event) => {
                event.preventDefault();
                if (!form.reportValidity()) return;

                let applications = [];
                try {
                    applications = JSON.parse(localStorage.getItem(storageKey) || '[]');
                } catch {
                    applications = [];
                }

                const formData = new FormData(form);
                applications.unshift({
                    id: `${Date.now()}-${Math.random().toString(16).slice(2)}`,
                    type: 'Instructor application',
                    name: formData.get('name'),
                    email: formData.get('email'),
                    major: formData.get('major'),
                    state: 'pending',
                    submittedAt: new Intl.DateTimeFormat('en', {
                        dateStyle: 'medium'
                    }).format(new Date())
                });
                localStorage.setItem(storageKey, JSON.stringify(applications));
                message.textContent =
                    'Your application preview is saved in this browser. You can review it from My applications.';
                message.classList.remove('d-none');
                message.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            });
        })();
    </script>
@endsection --}}
