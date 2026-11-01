{{-- @dd($courses) --}}
@extends('layouts.website')
@section('title', 'Eduleb - Our Courses ')
@section('CSS')
    <style>
        .courses-grid>[class*="col-"] {
            display: flex;
        }

        .courses-grid .single_course {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .courses-grid .course-rating {
            display: flex;
            justify-content: center;
        }

        .courses-grid .single_course h4 {
            height: 64px;
            overflow: hidden;
        }

        .courses-grid .single_course h4 a {
            display: -webkit-box;
            overflow: hidden;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .courses-grid .single_c_img {
            aspect-ratio: 16 / 9 !important;
            overflow: hidden !important;
        }

        .courses-grid .single_c_img img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
        }

        .courses-grid .single_course .price {
            margin-top: auto;
        }

        .courses-hero {
            position: relative;
            overflow: hidden;
            padding: 150px 0 88px;
            background:
                radial-gradient(circle at 82% 18%, rgba(255, 255, 255, .13), transparent 25%),
                linear-gradient(110deg, rgba(20, 33, 81, .94), rgba(82, 95, 225, .82)),
                url('{{ asset('assets/img/bg/section-top.jpg') }}') center / cover;
        }

        .courses-hero__eyebrow {
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

        .courses-hero__eyebrow i {
            font-size: 16px;
        }

        .courses-hero__title {
            max-width: 720px;
            margin: 0 0 16px;
            color: #fff;
            font-size: clamp(40px, 5vw, 60px);
            font-weight: 700;
            line-height: 1.1;
        }

        .courses-hero__description {
            max-width: 650px;
            margin: 0;
            color: rgba(255, 255, 255, .84);
            font-size: 17px;
            line-height: 1.7;
        }

        .courses-hero__actions {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-top: 28px;
        }

        .courses-hero__button {
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

        .courses-hero__button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .18);
            color: #1a2d62;
        }

        .courses-hero__count {
            color: rgba(255, 255, 255, .9);
            font-size: 14px;
        }

        .courses-hero__count strong {
            color: #fff;
            font-size: 18px;
        }

        .courses-hero__breadcrumb {
            margin-top: 28px;
            color: rgba(255, 255, 255, .72);
            font-size: 14px;
        }

        .courses-hero__breadcrumb a {
            color: #fff;
            text-decoration: none;
        }

        .courses-hero__breadcrumb a:hover {
            text-decoration: underline;
        }

        @media (max-width: 575.98px) {
            .courses-hero {
                padding: 125px 0 64px;
            }

            .courses-hero__description {
                font-size: 15px;
            }

            .courses-hero__actions {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
            }
        }
    </style>
@endsection
@section('content')
    <section class="courses-hero">
        <div class="container">
            <div class="courses-hero__eyebrow">
                <i class="ti-book" aria-hidden="true"></i>
                Learn something new
            </div>
            <h1 class="courses-hero__title">Find the course that moves you forward.</h1>
            <p class="courses-hero__description">
                Explore expert-led courses designed to help you build practical skills, discover new interests, and reach
                your goals.
            </p>
            <div class="courses-hero__actions">
                <a class="courses-hero__button" href="#courses-list">
                    Explore courses <i class="ti-arrow-down" aria-hidden="true"></i>
                </a>
                <span class="courses-hero__count">
                    <strong>{{ $courses->count() }}</strong>
                    {{ $courses->count() === 1 ? 'course' : 'courses' }} to explore
                </span>
            </div>
            <nav class="courses-hero__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true"> / </span>
                <span aria-current="page">Courses</span>
            </nav>
        </div>
    </section>

    <!-- START COURSE -->
    <section class="home_course section-padding" id="courses-list">
        <div class="container">
            <div class="row courses-grid">
                {{-- <input type="time"> --}}
                @forelse ($courses as $course)
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="single_course">
                            <div class="single_c_img">
                                <img src="{{ filled($course->outer_image) ? asset($course->outer_image) : asset('assets/img/course/4.png') }}"
                                    class="img-fluid" alt="course-image" />
                                {{-- <span style="bottom: none !important;top: none;">{{ $course->type }}</span> --}}
                            </div>
                            <div class="course-rating">
                                @for ($i = 0; $i < $course->star_num; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </div>
                            <h4><a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a></h4>
                            <p><span class="ti-book"> </span> {{ $course->total_lectures . ' Lectures' ?? 'Not Avilable' }}
                            </p>
                            <p><span class="ti-alarm-clock"> </span>{{ $course->duration ?? 'Not Avilable' }}</p>
                            @auth

                                @if (auth()->user()->courses->contains($course->id))
                                    <div class="price"
                                        style="font-weight: bold;color: rgb(130, 0, 0);font-size: large;text-decoration: underline;">
                                        Enrolled</div>
                                @else
                                    @if ($course->available_seats <= 0)
                                        <div class="price"
                                            style="font-weight: bold;color: rgb(130, 0, 0);font-size: large;text-decoration: underline;">
                                            No More Seats</div>
                                    @else
                                        <div class="price">Course Fee - {{ $course->price }} $</div>
                                    @endif
                                @endif
                            @endauth
                            @guest

                                <div class="price">Course Fee - {{ $course->price }} $</div>
                            @endguest
                        </div>
                    </div><!-- END COL -->
                @empty
                    <div class="text-center p-12">No Courses Yet !</div>
                @endforelse

            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END COURSE -->
@endsection()
