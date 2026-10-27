@extends('layouts.website')
@section('title', 'Eduleb - Home ')
@section('content')
    <!-- START HOME -->
    <section class="home_bg hb_height"
        style="background-image: url(assets/img/bg/home-bg.jpg);  background-size:cover; background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12">
                    <div class="hero-text ht_top">
                        <h1><span>Smart Study</span> Where Knowledge Meets the Web</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, consectetur adipiscing elit tempor ut
                            labore</p>
                    </div>

                    <div class="home_sb">
                        <form action="{{ route('home.search') }}" method="POST" class="banner_subs">
                            <x-input name="content" type="text" class="form-control home_si"
                                placeholder="Search your course here" required="required" />
                            <button type="submit" class="subscribe__btn">Search <i
                                    class="fa fa-paper-plane-o"></i></button>
                        </form>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-6 col-sm-12 col-xs-12">
                    <div class="hero-text-img">
                        <img src="{{ asset('assets/img/home-img2.png') }}" class="img-fluid" alt="" />
                        <div class="home_ps">
                            <span class="ti-user"></span>
                            <h2>4500+</h2>
                            <p>Active student</p>
                        </div>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END  HOME -->

    <!-- START COUNTER -->
    <section class="count_area counter_feature">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="single-counter">
                        <span class="ti-folder sc_one"></span>
                        <h2 class="counter-num">{{ $courses_num }}</h2>
                        <p>Our Online Course</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="single-counter">
                        <span class="ti-medall-alt sc_two"></span>
                        <h2 class="counter-num">299</h2>
                        <p>Academic Programs</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="single-counter">
                        <span class="ti-id-badge sc_three"></span>
                        <h2 class="counter-num">{{ $instructors_num }}</h2>
                        <p>Verified Instructor</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="single-counter">
                        <span class="ti-user sc_four"></span>
                        <h2 class="counter-num">{{ $student_num }}</h2>
                        <p>Enrolled Students</p>
                    </div>
                </div><!-- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END COUNTER -->

    <!-- START CATEGORY -->
    <section class="top_cat__area section-padding"
        style="background-image: url(assets/img/bg/shape-1.png);  background-size:cover; background-position: center center;">
        <div class="container">
            <div class="section-title text-center">
                <h2>Start your journey With us</h2>
                <p>We offer a brand new approach to the most basic learning paradigms. Choose from a wide range of learning
                    options and gain new skills! Our school is know.</p>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0">
                    <div class="single_tp">
                        <span class="sc_one">01</span>
                        <h3>Expert <br />Teacher</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur notted adipisicing elit ut labore.</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s"
                    data-wow-offset="0">
                    <div class="single_tp">
                        <span class="sc_two">02</span>
                        <h3>Quality <br />Education</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur notted adipisicing elit ut labore.</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s"
                    data-wow-offset="0">
                    <div class="single_tp">
                        <span class="sc_three">03</span>
                        <h3>Remote <br />Learning</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur notted adipisicing elit ut labore.</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s"
                    data-wow-offset="0">
                    <div class="single_tp">
                        <span class="sc_four">04</span>
                        <h3>Life Time <br />Support</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur notted adipisicing elit ut labore.</p>
                    </div>
                </div><!-- END COL -->
            </div><!-- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END CATEGORY -->

    <!-- START ABOUT US -->
    <section class="ab_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0">
                    <div class="ab_img">
                        <img src="{{ asset('assets/img/about1.png') }}" class="img-fluid" alt="image">
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                    data-wow-offset="0">
                    <div class="ab_content">
                        <h2>We Are Providing The Online Course In Global World</h2>
                        <p>We offer a brand new approach to the most basic learning paradigms. Choose from a wide range of
                            learning options and gain new skills! Our school is know.</p>
                        <p>We offer a brand new approach to the most basic learning paradigms. Choose from a wide range of
                            learning options and gain new skills! Our school is know.</p>
                        <ul>
                            <li><span class="ti-check"></span> Get access to <b>12,000+</b> of our top courses</li>
                            <li><span class="ti-check"></span> Popular topic to learn now in our online courses for student
                            </li>
                            <li><span class="ti-check"></span> Find the right instructor for you</li>
                        </ul>
                        <a class="btn_one" href="{{ route('courses.index') }}">View All Courses <i
                                class="ti-arrow-top-right"></i></a>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END ABOUT US -->

    <!-- START CATEGORY -->
    <section class="top_cat__area section-padding"
        style="background-image: url(assets/img/bg/section-2.jpg);  background-size:cover; background-position: center center;">
        <div class="container">
            <div class="section-title text-center">
                <h2>Find out by popular Categories</h2>
                <p>We offer a brand new approach to the most basic learning paradigms. Choose from a wide range of learning
                    options and gain new skills! Our school is know.</p>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                    data-wow-offset="0">
                    <div class="cat_list">
                        <ul>
                            @forelse ($tags as $tag)
                                <li><a href="{{ route('tags.show', $tag->id) }}"><img src="{{ asset($tag->image) }}"
                                            alt="category-image" />
                                        {{ $tag->name }}</a></li>
                            @empty
                                <div style="font-size:35px " class="font-semibold text-center">No Categories Yet !</div>
                            @endforelse
                        </ul>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END CATEGORY -->

    <!-- START COURSE -->
    <section class="home_course section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-6 col-xs-12">
                    <div class="section-title">
                        <h2>Join with more than <b>80,000+ </b> <br />Courses & Learning creators.</h2>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="cour_btn">
                        <a href="{{ route('courses.index') }}" class="btn_one">View all Courses <i
                                class="ti-arrow-top-right"></i></a>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->


            <div class="row">
                @forelse ($courses_sample as $course)
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="single_course">
                            <div class="single_c_img">
                                <img src="{{ asset($course->outer_image) ?? asset('assets/img/course/4.png') }}"
                                    class="img-fluid" alt="course-image" />
                                <span style="bottom: none !important;top: none;">{{ $course->type ?? 'Eduction' }}</span>
                            </div>
                            @for ($i = 0; $i <= $course->star_num; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <h4><a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a></h4>
                            <p><span class="ti-book"> </span>
                                {{ $course->total_lectures . ' Lectures' ?? 'Not Avilable' }}
                            </p>
                            <p><span class="ti-alarm-clock"> </span>{{ $course->duration ?? 'Not Avilable' }}</p>
                            <div class="price">Course Fee - {{ $course->price }} $</div>
                        </div>
                    </div><!-- END COL -->
                @empty
                    <div class="text-center font-semibold">No Courses Yet</div>
                @endforelse


            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END COURSE -->

    <!-- START COMPANY PARTNER LOGO  -->
    <div class="partner-logo section-padding">
        <div class="container">
            <div class="row part_bg">
                <div class="col-lg-4 col-sm-4 col-xs-12">
                    <div class="partner_title">
                        <h3>Helping <span>86,000+</span> global companies take the gloves off </h3>
                    </div>
                </div><!-- END COL  -->
                <div class="col-lg-8 col-sm-8 col-xs-12 text-center">
                    <div class="partner">
                        <a href="#"><img src="{{ asset('assets/img/clients/1.png') }}" alt="image"></a>
                        <a href="#"><img src="{{ asset('assets/img/clients/2.png') }}" alt="image"></a>
                        <a href="#"><img src="{{ asset('assets/img/clients/3.png') }}" alt="image"></a>
                        <a href="#"><img src="{{ asset('assets/img/clients/4.png') }}" alt="image"></a>
                        <a href="#"><img src="{{ asset('assets/img/clients/5.png') }}" alt="image"></a>
                        <a href="#"><img src="{{ asset('assets/img/clients/2.png') }}" alt="image"></a>
                        <a href="#"><img src="{{ asset('assets/img/clients/1.png') }}" alt="image"></a>
                        <a href="#"><img src="{{ asset('assets/img/clients/3.png') }}" alt="image"></a>
                        <a href="#"><img src="{{ asset('assets/img/clients/4.png') }}" alt="image"></a>
                    </div>
                </div><!-- END COL  -->
            </div><!--END  ROW  -->
        </div><!-- END CONTAINER  -->
    </div>
    <!-- END COMPANY PARTNER LOGO -->

    <!-- START VIDEO -->
    <section class="vid_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 vp_top wow fadeInUDown" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0">
                    /<div class="video-area"
                        style="background-image: url(assets/img/bg/video.jpg);  background-size:cover; background-position: center center;">
                        <a href="https://www.youtube.com/watch?v=RXv_uIN6e-Y" class="magnific_popup video-button"><i
                                class="fa fa-play"></i></a>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END VIDEO -->

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
                                <a href="{{ route('instructors.show', $instructor->id) }}"><img
                                        src="{{ asset($instructor->personal_image) }}" alt=""></a>
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
                    <div style="font-size:30px" class="col-12 font-semibold text-center p-12">No Instructors Yet!</div>
                @endforelse
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END TEAM -->

    <!-- START PROMO -->
    <section class="ab_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                    data-wow-offset="0">
                    <div class="ab_content">
                        <h2>Why Choose Us For Your Online Education Courses</h2>
                        <p>We offer a brand new approach to the most basic learning paradigms. Choose from a wide range of
                            learning options and gain new skills! Our school is know.</p>
                        <p>We offer a brand new approach to the most basic learning paradigms. Choose from a wide range of
                            learning options and gain new skills! Our school is know.</p>
                        <ul>
                            <li><span class="ti-check"></span> Get access to <b>12,000+</b> of our top courses</li>
                            <li><span class="ti-check"></span> Popular topic to learn now in our online courses for student
                            </li>
                            <li><span class="ti-check"></span> Find the right instructor for you</li>
                        </ul>
                        <a class="btn_one" href="{{ route('courses.index') }}">View All Courses <i
                                class="ti-arrow-top-right"></i></a>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0">
                    <div class="ab_img">
                        <img src="{{ asset('assets/img/about3.png') }}" class="img-fluid" alt="image">
                        <div class="home_ps2">
                            <span class="ti-book"></span>
                            <h2>3300+</h2>
                            <p>Online Course</p>
                        </div>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END PROMO -->

    <!-- START TESTIMONIALS -->
    <section class="testi_area section-padding">
        <div class="container">
            <div class="section-title">
                <h2>What Student’s Say To Do <br />Their Online Course</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12">
                    <div class="ab_img">
                        <img src="{{ asset('assets/img/review.png') }}" class="img-fluid" alt="image">
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-6 col-sm-12 col-xs-12">
                    <div id="testimonial-slider" class="owl-carousel">
                        <div class="testimonial">
                            <img src="{{ asset('assets/img/quote.png') }}" alt="" />
                            <div class="testimonial_content">
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <p>Aqestic optio amet a ququam saepe aliquid voluate dicta fuga dolor saerror sed earum a
                                    magni soluta quam minus dolor dolor sed earum a magni soluta autem dolor error error sit
                                    quam minus sint rem a rerum dolobus veritatis delectus.</p>
                            </div>
                            <div class="testi_pic_title">
                                <img src="{{ asset('assets/img/testimonial/1.png') }}" alt="">
                                <h4>Ajmain Adil</h4>
                                <p>Groton Inc</p>
                            </div>
                        </div><!-- END TESTIMONIAL -->
                        <div class="testimonial">
                            <img src="{{ asset('assets/img/quote.png') }}" alt="" />
                            <div class="testimonial_content">
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <p>Aqestic optio amet a ququam saepe aliquid voluate dicta fuga dolor saerror sed earum a
                                    magni soluta quam minus dolor dolor sed earum a magni soluta autem dolor error error sit
                                    quam minus sint rem a rerum dolobus veritatis delectus.</p>
                            </div>
                            <div class="testi_pic_title">
                                <img src="{{ asset('assets/img/testimonial/2.png') }}" alt="">
                                <h4>Sharukh Khan</h4>
                                <p>Red Chili Inc</p>
                            </div>
                        </div><!-- END TESTIMONIAL -->
                        <div class="testimonial">
                            <img src="{{ asset('assets/img/quote.png') }}" alt="" />
                            <div class="testimonial_content">
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <p>Aqestic optio amet a ququam saepe aliquid voluate dicta fuga dolor saerror sed earum a
                                    magni soluta quam minus dolor dolor sed earum a magni soluta autem dolor error error sit
                                    quam minus sint rem a rerum dolobus veritatis delectus.</p>
                            </div>
                            <div class="testi_pic_title">
                                <img src="{{ asset('assets/img/testimonial/3.png') }}" alt="">
                                <h4>Anushka sharma</h4>
                                <p>Naika Company</p>
                            </div>
                        </div><!-- END TESTIMONIAL -->
                        <div class="testimonial">
                            <img src="{{ asset('assets/img/quote.png') }}" alt="" />
                            <div class="testimonial_content">
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <p>Aqestic optio amet a ququam saepe aliquid voluate dicta fuga dolor saerror sed earum a
                                    magni soluta quam minus dolor dolor sed earum a magni soluta autem dolor error error sit
                                    quam minus sint rem a rerum dolobus veritatis delectus.</p>
                            </div>
                            <div class="testi_pic_title">
                                <img src="{{ asset('assets/img/testimonial/4.png') }}" alt="">
                                <h4>Ajmain Adil</h4>
                                <p>Groton Inc</p>
                            </div>
                        </div><!-- END TESTIMONIAL -->
                        <div class="testimonial">
                            <img src="{{ asset('assets/img/quote.png') }}" alt="" />
                            <div class="testimonial_content">
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <i class="ti-star"></i>
                                <p>Aqestic optio amet a ququam saepe aliquid voluate dicta fuga dolor saerror sed earum a
                                    magni soluta quam minus dolor dolor sed earum a magni soluta autem dolor error error sit
                                    quam minus sint rem a rerum dolobus veritatis delectus.</p>
                            </div>
                            <div class="testi_pic_title">
                                <img src="{{ asset('assets/img/testimonial/5.png') }}" alt="">
                                <h4>Ajmain Adil</h4>
                                <p>Groton Inc</p>
                            </div>
                        </div><!-- END TESTIMONIAL -->
                    </div><!-- END TESTIMONIAL SLIDER -->
                </div><!-- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END TESTINUNIALS -->

    <!-- START BLOG -->
    <section id="blog" class="blog_area section-padding">
        <div class="container">
            <div class="section-title text-center">
                <h2>Latest Blog & news</h2>
                <p>We offer a brand new approach to the most basic learning paradigms. Choose from a wide range of learning
                    options and gain new skills! Our school is know.</p>
            </div>
            <div class="row">
                @forelse ($blogs as $blog)
                    <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                        data-wow-offset="0">
                        <div class="single_blog">
                            <img src="{{ asset($blog->image) }}" class="img-fluid" alt="image" />
                            <div class="content_box">
                                @if ($blog->tags->count() > 0)
                                    <span>{{ $blog->created_at }} | <a
                                            href="{{ route('tags.show', $blog->tags->first()->id) }}">{{ $blog->tags->first()->name }}</a></span>
                                @else
                                    <span>{{ $blog->created_at }} | <span>Eduction</span></span>
                                @endif
                                <h2><a href="blog.html">Professional Mobile Painting and Sculpting</a></h2>
                                <a class="btn_one" href="blog.html">Read More <i class="ti-arrow-top-right"></i></a>
                            </div>
                        </div>
                    </div><!-- END COL-->

                @empty
                @endforelse

            </div><!-- / END ROW -->
        </div><!-- END CONTAINER  -->
    </section>
    <!-- END BLOG -->
@endsection()
