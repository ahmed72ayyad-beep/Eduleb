{{-- @dd($courses) --}}
@extends('layouts.website')
@section('title', 'Eduleb - Our Courses ')
@section('content')
    <!-- START SECTION TOP -->
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <h1>All Course</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li> / Courses</li>
                    </ul>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->

    <!-- START COURSE -->
    <section class="home_course section-padding">
        <div class="container">
            <div class="row">
                {{-- <input type="time"> --}}
                @forelse ($courses as $course)
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="single_course">
                            <div class="single_c_img">
                                <img src="{{ asset($course->outer_image) ?? asset('assets/img/course/4.png') }}"
                                    class="img-fluid" alt="course-image" />
                                <span style="bottom: none !important;top: none;">{{ $course->type }}</span>
                            </div>
                            @for ($i = 0; $i <= $course->star_num; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <h4><a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a></h4>
                            <p><span class="ti-book"> </span> {{ $course->total_lectures  . ' Lectures' ?? 'Not Avilable' }}
                            </p>
                            <p><span class="ti-alarm-clock"> </span>{{ $course->duration  ?? 'Not Avilable' }}</p>
                            <div class="price">Course Fee - {{ $course->price }} $</div>
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
