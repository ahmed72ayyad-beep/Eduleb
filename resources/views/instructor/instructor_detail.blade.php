@extends('layouts.website')
@section('title', 'Eduleb - Instructor Details ')
@section('content')
{{-- @dd($instructor) --}}
<!-- START SECTION TOP -->
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <h1>Instructor Details</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li> / instructor details</li>
                    </ul>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->

    <!-- START AGENT PROFILE -->
    <section class="template_agent section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="single_agent">
                        <div class="single_agent_image">
                            <img src="{{ asset($instructor->personal_image) }}" class="img-fluid" alt="" />
                        </div>
                        <div class="single_agent_content">
                            <h4>{{ $instructor->name }}</h4>
                            <h5>{{ $instructor->major }} Instructor</h5>
                            <p>{{ $instructor->description }}</p>
                            <ul>
                                <li><i class="fa fa-envelope-o"></i>{{ $instructor->email }}</li>
                                <li><i class="fa fa-phone"></i>{{ $instructor->phone }}</li>
                                <li><i class="fa fa-plane"></i><a class="text-blue-700 hover:text-blue-500"
                                        href="{{ $instructor->portfolio_link }}">{{ $instructor->portfolio_link }}</a></li>
                                <li><i class="fa fa-skype"></i>skype.myinfo88</li>
                            </ul>
                        </div>
                        <div class="agent_social">
                            <ul class="list-inline">
                                <li><a href="#" class="top_f_facebook"><img src="{{ asset('assets/img/fb.svg') }}"
                                            alt="" /></a></li>
                                <li><a href="#" class="top_f_facebook"><img src="{{ asset('assets/img/pn.svg') }}"
                                            alt="" /></a></li>
                                <li><a href="#" class="top_f_facebook"><img src="{{ asset('assets/img/ins.svg') }}"
                                            alt="" /></a></li>
                            </ul>
                        </div>
                    </div><!--- END SINGLE ITEM -->
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END AGENT PROFILE -->
@endsection()
