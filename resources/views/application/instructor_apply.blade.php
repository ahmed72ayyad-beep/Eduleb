@extends('layouts.website')

@section('title', 'Apply to Teach | Eduleb')

@section('CSS')
    <style>
        .spicialmsg{
            color: blue;

        }
        label{
            font-size: 14px !important;
            margin-bottom: 4px !important;
             text-transform:capitalize !importantf;
        }
        .instructor-apply {
            --apply-ink: #0b104a;
            --apply-blue: #2d36bb;
            background: #f5f7fb;
            color: var(--apply-ink);
        }

        .instructor-apply .apply-hero {
            background: linear-gradient(115deg, #0b104a 0%, #202a8b 72%, #2d36bb 100%);
        }

        .instructor-apply .apply-field {
            min-height: 48px;
            border: 1px solid #d9deea;
            border-radius: 4px;
            box-shadow: none;
            color: #20243a;
        }

        .instructor-apply .apply-field:focus {
            border-color: var(--apply-blue);
            box-shadow: 0 0 0 3px rgb(45 54 187 / 12%);
        }

        .instructor-apply .apply-label {
            color: #28304e;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .instructor-apply .apply-submit {
            background: var(--apply-blue);
            border: 0;
            border-radius: 4px;
            color: #fff;
            font-weight: 700;
            min-height: 50px;
            padding: 0 24px;
            transition: background .2s ease, transform .2s ease;
        }

        .instructor-apply .apply-submit:hover {
            background: #202a8b;
            transform: translateY(-1px);
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
        <section class="apply-hero py-5 text-white">
            <div class="container py-4">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <p class="mb-2 text-uppercase fw-bold" style="color: #bac8ff;">Teach with Eduleb
                        </p>
                        <h1 class="mb-3 display-5 fw-bold text-white">Share what you know.</h1>
                        <p class="mb-0 fs-5" style="max-width: 650px; color: #e0e6ff;">Introduce your experience and the
                            subjects you care about. Your profile details help learners find the right guide.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ route('student.applications.index') }}" class="btn btn-outline-light px-4 py-3">View my
                            applications</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="container py-5">
            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <form enctype="multipart/form-data" id="instructor-application-form" action="{{ route('student.applications.store') }}" method="POST"
                        class="rounded bg-white p-4 p-md-5 shadow-sm" novalidate>
                        <div class="mb-4 border-bottom pb-4">
                            <p class="mb-1 text-uppercase fw-bold" style="font-size: 11px; color: #2d36bb;">Instructor
                                application</p>
                            <h2 class="mb-2 h3 fw-bold" style="color: #0b104a;">Your teaching profile</h2>
                            <p class="mb-0 text-muted">Complete the details below to prepare your application.</p>
                        </div>
                        <input type="hidden" name="type" value="instructor_application">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <x-input labelclass="apply-label" id="applicant-major" label="Area of expertise"
                                    class="form-control apply-field" id="applicant-major" name="major"
                                    placeholder="e.g. Product design" required />
                            </div>
                            <div class="col-md-6">
                                <x-input labelclass="apply-label" id="applicant-major" label="Professional title"
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
                                <x-input labelclass="apply-label" label="Your CV" class="form-control apply-field"
                                    id="applicant-image" name="CV" type="file" accept="PDF"
                                    spicialmsg="Sould be in english with max size 10m" spicialmsgclass="spicialmsg" />
                                <p class="mt-2 mb-0 small text-muted">PDF A clear, Pref and orgnaize CV.</p>
                            </div>
                        </div>

                        <div id="application-message" class="alert alert-success mt-4 d-none" role="status"></div>
                        <div
                            class="mt-2 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 border-top pt-4">
                            <p class="mb-0 small text-muted">Any Wrong Data Will Couse Reject The Application <span
                                    class="text-blue-900">Be Careful </span>
                            </p>
                            <button class="apply-submit" type="submit">Send application <span
                                    aria-hidden="true">→</span></button>
                        </div>
                    </form>
                </div>

                <aside class="col-lg-4">
                    <div class="position-sticky top-4">
                        <div class="overflow-hidden rounded-4 bg-white shadow-sm border border-slate-200">
                            <img class="w-100" src="{{ asset('assets/img/wellcome.png') }}"
                                alt="Learners studying together" style="aspect-ratio: 16 / 9; object-fit: cover;">

                            <div class="p-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="badge rounded-pill px-3 py-2 fw-semibold"
                                        style="background: #edf3ff; color: #2d36bb;">Instructor program</span>
                                    <span class="small text-muted">Quick steps</span>
                                </div>

                                <h2 class="mb-3 h5 fw-bold" style="color: #0b104a;">Become an Eduleb instructor</h2>

                                <ol class="list-unstyled mb-0">
                                    <li class="d-flex gap-3 border-top py-3">
                                        <span
                                            class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle fw-bold"
                                            style="width: 32px; height: 32px; background: #0b104a; color: #fff;">1</span>
                                        <div>
                                            <h3 class="mb-1 h6 fw-bold" style="color: #0b104a;">Add your expertise</h3>
                                            <p class="mb-0 small text-muted">Choose a clear subject area and professional
                                                title.</p>
                                        </div>
                                    </li>

                                    <li class="d-flex gap-3 border-top py-3">
                                        <span
                                            class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle fw-bold"
                                            style="width: 32px; height: 32px; background: #edf3ff; color: #2d36bb;">2</span>
                                        <div>
                                            <h3 class="mb-1 h6 fw-bold" style="color: #0b104a;">Describe your approach
                                            </h3>
                                            <p class="mb-0 small text-muted">Show how you teach and what learners can
                                                expect.</p>
                                        </div>
                                    </li>

                                    <li class="d-flex gap-3 border-top py-3">
                                        <span
                                            class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle fw-bold"
                                            style="width: 32px; height: 32px; background: #edf3ff; color: #2d36bb;">3</span>
                                        <div>
                                            <h3 class="mb-1 h6 fw-bold" style="color: #0b104a;">Keep it ready</h3>
                                            <p class="mb-0 small text-muted">Your preview remains available in the
                                                applications area.</p>
                                        </div>
                                    </li>
                                </ol>

                                <div class="mt-4 rounded-3 p-3" style="background: #f5f7fb;">
                                    <p class="mb-1 small fw-bold" style="color: #0b104a;">Need to leave?</p>
                                    <a class="small fw-semibold text-decoration-none" style="color: #2d36bb;"
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
