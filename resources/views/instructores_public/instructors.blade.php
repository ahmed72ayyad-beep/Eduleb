@extends('layouts.website')

@section('title', 'Eduleb - Instructors')

@section('CSS')
    <style>
        .instructors-hero {
            position: relative;
            overflow: hidden;
            padding: 150px 0 88px;
            background:
                radial-gradient(circle at 82% 18%, rgba(255, 255, 255, .13), transparent 25%),
                linear-gradient(110deg, rgba(20, 33, 81, .94), rgba(82, 95, 225, .82)),
                url('{{ asset('assets/img/bg/section-top.jpg') }}') center / cover;
        }

        .instructors-hero__eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 15px;
            color: #d7dcff;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .instructors-hero__eyebrow i {
            font-size: 16px;
        }

        .instructors-hero__title {
            max-width: 720px;
            margin: 0 0 16px;
            color: #fff;
            font-size: clamp(40px, 5vw, 60px);
            font-weight: 700;
            line-height: 1.1;
        }

        .instructors-hero__description {
            max-width: 650px;
            margin: 0;
            color: rgba(255, 255, 255, .84);
            font-size: 17px;
            line-height: 1.7;
        }

        .instructors-hero__actions {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-top: 28px;
        }

        .instructors-hero__button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 22px;
            border: 1px solid #fff;
            border-radius: 6px;
            background: #fff;
            color: #1a2d62;
            font-weight: 700;
            text-decoration: none;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .instructors-hero__button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .18);
            color: #1a2d62;
        }

        .instructors-hero__count {
            color: rgba(255, 255, 255, .9);
            font-size: 14px;
        }

        .instructors-hero__count strong {
            color: #fff;
            font-size: 18px;
        }

        .instructors-hero__breadcrumb {
            margin-top: 28px;
            color: rgba(255, 255, 255, .72);
            font-size: 14px;
        }

        .instructors-hero__breadcrumb a {
            color: #fff;
            text-decoration: none;
        }

        .instructors-hero__breadcrumb a:hover {
            text-decoration: underline;
        }

        @media (max-width: 575.98px) {
            .instructors-hero {
                padding: 125px 0 64px;
            }

            .instructors-hero__description {
                font-size: 15px;
            }

            .instructors-hero__actions {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
            }
        }

        .instructors-directory {
            padding: 76px 0 88px;
            background: #f6f7fc;
        }

        .instructors-directory__intro {
            margin-bottom: 40px;
        }

        .instructors-directory__eyebrow {
            display: inline-block;
            margin-bottom: 10px;
            color: #525fe1;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .instructors-directory__intro h2 {
            margin: 0 0 12px;
            color: #1a2d62;
            font-size: 38px;
            font-weight: 700;
            line-height: 1.2;
        }

        .instructors-directory__intro p {
            max-width: 650px;
            margin: 0;
            color: #6b7280;
            font-size: 16px;
            line-height: 1.7;
        }

        .instructors-page .instructor-apply-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 24px;
            border-radius: 6px;
            box-shadow: 0 8px 20px rgba(82, 95, 225, .2);
            white-space: nowrap;
        }

        .instructors-page .instructor-apply-link:hover {
            box-shadow: 0 12px 24px rgba(82, 95, 225, .28);
            transform: translateY(-2px);
        }

        .instructor-grid > [class*="col-"] {
            margin-bottom: 24px;
        }

        .instructor-card {
            height: 100%;
            overflow: hidden;
            border: 1px solid #e8eaf3;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 8px 24px rgba(26, 45, 98, .06);
            transition: border-color .25s ease, box-shadow .25s ease, transform .25s ease;
        }

        .instructor-card:hover {
            transform: translateY(-5px);
            border-color: rgba(82, 95, 225, .35);
            box-shadow: 0 16px 34px rgba(26, 45, 98, .12);
        }

        .instructor-card__photo {
            position: relative;
            display: block;
            overflow: hidden;
            aspect-ratio: 4 / 3;
            background: #edf0fb;
        }

        .instructor-card__photo > a {
            display: block;
            width: 100%;
            height: 100%;
        }

        .instructor-card__photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .35s ease;
        }

        .instructor-card:hover .instructor-card__photo img {
            transform: scale(1.05);
        }

        .instructor-card__social {
            position: absolute;
            bottom: 14px;
            left: 14px;
            display: flex;
            gap: 8px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .instructor-card__social a {
            display: grid;
            width: 36px;
            height: 36px;
            place-items: center;
            border: 1px solid rgba(255, 255, 255, .35);
            border-radius: 50%;
            background: rgba(26, 45, 98, .78);
            color: #fff;
            transition: background .2s ease, transform .2s ease;
        }

        .instructor-card__social a:hover {
            transform: translateY(-2px);
            background: #525fe1;
            color: #fff;
        }

        .instructor-card__body {
            padding: 22px 22px 18px;
        }

        .instructor-card__major {
            display: inline-block;
            margin-bottom: 8px;
            color: #525fe1;
            font-size: 13px;
            font-weight: 600;
        }

        .instructor-card__name {
            margin: 0;
            color: #1a2d62;
            font-size: 20px;
            font-weight: 700;
            line-height: 1.35;
        }

        .instructor-card__name a {
            color: inherit;
            text-decoration: none;
        }

        .instructor-card__name a:hover {
            color: #525fe1;
        }

        .instructor-card__courses {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid #eef0f6;
            color: #697386;
            font-size: 14px;
        }

        .instructor-card__courses i {
            color: #525fe1;
            font-size: 15px;
        }

        .instructor-empty {
            width: 100%;
            padding: 54px 24px;
            border: 1px dashed #cfd4e8;
            border-radius: 12px;
            background: #fff;
            text-align: center;
        }

        .instructor-empty__icon {
            display: grid;
            width: 64px;
            height: 64px;
            margin: 0 auto 18px;
            place-items: center;
            border-radius: 50%;
            background: #eef0ff;
            color: #525fe1;
            font-size: 24px;
        }

        .instructor-empty h3 {
            margin: 0 0 8px;
            color: #1a2d62;
            font-size: 22px;
            font-weight: 700;
        }

        .instructor-empty p {
            margin: 0;
            color: #6b7280;
        }

        @media (max-width: 991.98px) {
            .instructors-directory__intro h2 {
                font-size: 34px;
            }

            .instructors-directory__action {
                margin-top: 24px;
            }
        }

        @media (max-width: 575.98px) {
            .instructors-directory {
                padding: 54px 0 64px;
            }

            .instructors-directory__intro h2 {
                font-size: 30px;
            }

            .instructors-directory__action {
                text-align: left;
            }

            .instructors-page .instructor-apply-link {
                padding: 13px 18px;
                white-space: normal;
            }
        }
    </style>
@endsection

@section('content')
    <main class="instructors-page">
        <section class="instructors-hero">
            <div class="container">
                <div class="instructors-hero__eyebrow">
                    <i class="ti-user" aria-hidden="true"></i>
                    Learn from the best
                </div>
                <h1 class="instructors-hero__title">Meet the instructors who move you forward.</h1>
                <p class="instructors-hero__description">
                    Connect with experienced educators ready to help you build practical skills, discover new interests,
                    and reach your goals.
                </p>
                <div class="instructors-hero__actions">
                    <a class="instructors-hero__button" href="#instructors-list">
                        Explore instructors <i class="ti-arrow-down" aria-hidden="true"></i>
                    </a>
                    <span class="instructors-hero__count">
                        <strong>{{ $instructors->count() }}</strong>
                        {{ $instructors->count() === 1 ? 'instructor' : 'instructors' }} to explore
                    </span>
                </div>
                <nav class="instructors-hero__breadcrumb" aria-label="Breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span aria-hidden="true"> / </span>
                    <span aria-current="page">Instructors</span>
                </nav>
            </div>
        </section>

        <section class="instructors-directory" id="instructors-list">
            <div class="container">
                <div class="instructors-directory__intro">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <span class="instructors-directory__eyebrow">Learn from the best</span>
                            <h2>Meet our instructors</h2>
                            <p>Discover experienced educators who are ready to help you build skills and reach your goals.</p>
                        </div>
                        <div class="col-lg-4 instructors-directory__action text-lg-right">
                            <a class="btn_one instructor-apply-link" href="{{ route('instructor.apply') }}">
                                Apply to become an instructor <i class="ti-arrow-top-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row instructor-grid">
                    @forelse ($instructors as $instructor)
                        <div class="col-lg-3 col-md-6">
                            <article class="instructor-card">
                                <div class="instructor-card__photo">
                                    <a href="{{ route('instructors.show', $instructor->id) }}"
                                        aria-label="View {{ $instructor->name }}'s profile">
                                        <img src="{{ asset($instructor->personal_image) }}" alt="{{ $instructor->name }}">
                                    </a>
                                    <ul class="instructor-card__social" aria-label="Social links">
                                        <li><a href="#" aria-label="X"><i class="fa-brands fa-x-twitter"
                                                    aria-hidden="true"></i></a></li>
                                        <li><a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"
                                                    aria-hidden="true"></i></a></li>
                                        <li><a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"
                                                    aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <div class="instructor-card__body">
                                    <span class="instructor-card__major">{{ $instructor->major }}</span>
                                    <h3 class="instructor-card__name">
                                        <a href="{{ route('instructors.show', $instructor->id) }}">{{ $instructor->name }}</a>
                                    </h3>
                                    <div class="instructor-card__courses">
                                        <i class="ti-book" aria-hidden="true"></i>
                                        <span>{{ $instructor->courses->count() }} Courses</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @empty
                        <div class="instructor-empty">
                            <span class="instructor-empty__icon ti-user" aria-hidden="true"></span>
                            <h3>No instructors yet</h3>
                            <p>Check back soon to meet our teaching community.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@endsection
