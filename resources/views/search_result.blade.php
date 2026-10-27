@extends('layouts.website')
@section('title', 'Eduleb - Home ')
@section('CSS')
    <style>
        #instructor {
            transition: 0.5s;
        }

        #instructor:hover {
            color: rgb(100, 100, 220) !important;
            transform: scale(0.90) !important;
        }

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

        .courses-grid .single_c_img {
            aspect-ratio: 16 / 9;
            overflow: hidden;
        }

        .courses-grid .single_c_img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .courses-grid .single_course .price {
            margin-top: auto;
        }
    </style>
@endsection
@section('content')
    <!-- START SECTION TOP -->
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <h1>All Course</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li> / Search</li>
                    </ul>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->

    <!-- START COURSE -->
    <section class="home_course section-padding">
        <div class="container">
            <div class="row courses-grid">
                @if (isset($instructor))
                    <h2 style="margin: -20px 0px 60px 0px;"><span style="color: red">#</span> Courses Belong To <a
                            id="instructor" href="{{ route('instructors.show', $instructor->id) }}"
                            style="color: rgb(0, 0, 160)">{{ $instructor->name }}</a></h2>
                @else
                    <h2 style="margin: -20px 0px 60px 0px;"><span style="color: red">#</span> Search Result About <span style="color: rgb(0, 0, 160)">
                            "{{ $value }}"</span> </h2>
                @endif

                {{-- <input type="time"> --}}
                @forelse ($instructor_courses as $course)
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="single_course">
                            <div class="single_c_img">
                                <img src="{{ filled($course->outer_image) ? asset($course->outer_image) : asset('assets/img/course/4.png') }}"
                                    class="img-fluid" alt="course-image" />
                                <span style="bottom: none !important;top: none;">{{ $course->type }}</span>
                            </div>
                            <div class="course-rating">
                                @for ($i = 0; $i <= $course->star_num; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </div>
                            <h4><a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a></h4>
                            <p><span class="ti-book"> </span> {{ $course->total_lectures . ' Lectures' ?? 'Not Avilable' }}
                            </p>
                            <p><span class="ti-alarm-clock"> </span>{{ $course->duration ?? 'Not Avilable' }}</p>
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
                        </div>
                    </div><!-- END COL -->
                @empty
                    <div style="font-size: xx-large; text-align: center;margin-bottom: 90px;margin-top: 30px">No Results !</div>
                @endforelse

            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END COURSE -->
@endsection()
