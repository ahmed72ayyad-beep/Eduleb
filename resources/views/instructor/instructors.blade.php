@extends('layouts.website')

@section('title', 'Eduleb - Instructors')
@section('content')
    <!-- START SECTION TOP -->
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <h1>Our instructor</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li> / instructor</li>
                    </ul>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->

    <!-- START TEAM -->
    <section class="team_area section-padding">
        <div class="container">
            <div class="section-title text-center">
                <h2>Meet our Instructors</h2>
                <p>We offer a brand new approach to the most basic learning paradigms. Choose from a wide range of learning
                    options and gain new skills! Our school is know.</p>
            </div>
            <div class="row">
                @forelse ($instructors as $instructor)
                    <div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                        data-wow-offset="0">
                        <div class="our-team">
                            <div class="team-content">
                                <a href="{{ route("instractors.show",$instructor->id) }}"><img src="{{ asset($instructor->personal_image) }}" alt=""></a>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa-solid fa-x"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                            <div class="team-prof">
                                <h3>{{ $instructor->name }}</h3>
                                <span>{{ $instructor->major }}</span>
                            </div>
                            <div class="sth_det2">
                                <span class="ti-file"> <u>{{ $instructor->courses->count() }} Course</u></span>
                                {{-- <span class="ti-user"> <u>{{ $instructor->students->count() }} Student</u></span> --}}
                            </div>
                        </div>
                    </div><!--- END COL -->
                @empty
                    <div style="font-size: xx-large">No Intructor Yet </div>
                @endforelse
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END TEAM -->
@endsection()
