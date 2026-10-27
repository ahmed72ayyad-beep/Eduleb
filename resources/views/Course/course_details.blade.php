@extends('layouts.website')
@section('title', "Eduleb - $course->title")
@section('CSS')

    <style>
        #ins-image {
            transition: 0.6s;
            border-radius: 52%;
            width: 27%;
        }

        #ins-image:hover {
            transform: scale(1.09) translate(0px, -10px) rotateX(6deg) rotateY(4deg) rotateZ(0deg);

        }

        .course-detail-image-frame {
            aspect-ratio: 16 / 9;
            overflow: hidden;
            background: #eef2f6;
        }

        .course-detail-image-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .course-details-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .course-details-meta span {
            margin-right: 0;
            padding: 7px 10px;
            border-radius: 4px;
            background: #f1f5f9;
            font-size: 14px;
        }

        .single_event_single {
            overflow: hidden;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        }

        .single_event_text_single {
            padding: 8px 24px 22px;
        }

        .single_event_text_single h4 {
            font-size: 30px;
            line-height: 1.25;
        }

        .single_event_text_single p {
            line-height: 1.7;
        }

        .course-details-content {
            margin-top: 28px;
            border: 1px solid #e5e7eb;
            background: #fff;
        }

        .course-details-content .nav {
            border-color: #e5e7eb;
        }

        .course-details-content .nav li {
            border-color: #e5e7eb;
        }

        .course-details-content .nav li a {
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .course-details-content .overview {
            line-height: 1.7;
        }

        .course-details-content .overview p {
            color: #475569;
        }

        .course-details-content .details-buttons-area>div {
            gap: 10px;
        }

        .course-support-trigger {
            align-self: flex-start;
            padding: 9px 13px;
            border: 1px solid #dbe3ed;
            border-radius: 4px;
            background: #f8fafc;
            color: #334e8c;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .course-support-trigger:hover,
        .course-support-trigger:focus-visible {
            border-color: #b8c7df;
            background: #eef3f9;
        }

        .related-course-image {
            object-fit: cover;
        }

        .review-contents li .thumb {
            width: 6rem;
            height: 6rem;
            overflow: hidden;
            border-radius: 50%;
            background: #eef2f6;
        }

        .review-contents li .thumb img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 50%;
        }

        .course-enrollment-status {
            display: inline-block;
            padding: 8px 12px;
            border: 1px solid #cfe7d5;
            border-radius: 4px;
            background: #f0f8f2;
            color: #24613a;
            font-size: 14px;
            font-weight: 600;
        }

        .course-login-prompt {
            margin: 0;
            padding: 10px 12px;
            border: 1px solid #dbe3ed;
            border-radius: 4px;
            background: #f8fafc;
            color: #475569;
        }

        .course-login-prompt a {
            margin-left: 4px;
            color: #334e8c;
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .course-support-overlay[hidden] {
            display: none;
        }

        .course-support-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            background: rgba(15, 23, 42, 0.55);
        }

        .course-support-dialog {
            position: relative;
            width: min(100%, 540px);
            max-height: calc(100vh - 32px);
            overflow-y: auto;
            padding: 28px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 18px 55px rgba(15, 23, 42, 0.25);
        }

        .course-support-dialog h3 {
            margin: 0 36px 6px 0;
        }

        .course-support-dialog p {
            margin-bottom: 18px;
        }

        .course-support-close {
            position: absolute;
            top: 12px;
            right: 14px;
            border: 0;
            background: transparent;
            font-size: 26px;
            line-height: 1;
            cursor: pointer;
        }

        .course-support-form label {
            display: block;
            margin: 0 0 5px;
            font-weight: 600;
        }

        .course-support-form input,
        .course-support-form textarea {
            width: 100%;
            margin-bottom: 12px;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            font: inherit;
        }

        .course-support-form textarea {
            min-height: 96px;
            resize: vertical;
        }

        @media (max-width: 480px) {
            .review-contents li .thumb {
                width: 4.5rem;
                height: 4.5rem;
            }

            .single_event_text_single {
                padding: 4px 16px 18px;
            }

            .single_event_text_single h4 {
                font-size: 24px;
            }

            .course-support-dialog {
                padding: 22px 18px;
            }
        }
    </style>




@endsection
@section('content')

    <!-- START SECTION TOP -->
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <h1>Course details</h1>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li> / Course details</li>
                    </ul>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->

    <!-- START COURSE -->
    <section class="our_event section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-8 col-xs-12">
                    <div class="single_event_single">
                        <div class="course-detail-image-frame">
                            <img alt="" class="img-fluid"
                                src="{{ filled($course->inner_image) ? asset($course->inner_image) : asset('assets/img/course/4.png') }}" />
                        </div>
                        <div class="single_event_text_single">
                            <h4>{{ $course->title }}</h4>
                            <div class="course-details-meta">
                                <span><i class="fa fa-calendar"></i>{{ $course->date ?? 'Recorded Course' }}</span>
                                <span><i class="fa fa-clock-o"></i>{{ $course->duration ?? 'Not available' }}</span>
                                <span><i class="fa fa-table"></i><strong>{{ $course->available_seats ?? 'Not available' }}
                                        Seats
                                        Available</strong></span>
                            </div>
                            <p>
                                {{ $course->description ?? 'Not available' }}
                            </p>
                        </div>
                    </div><!--- END SINGLE EVENT -->
                    <div class="course-details-content section-bg">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a href="#overview" class="nav-link active" data-bs-toggle="tab">Overview</a>
                            </li>
                            <li>
                                <a href="#curriculum" class="nav-link" data-bs-toggle="tab">Curriculum </a>
                            </li>
                            <li class="nav-item">
                                <a href="#instructor" class="nav-link" data-bs-toggle="tab">instructor</a>
                            </li>
                            <li class="nav-item">
                                <a href="#reviews" class="nav-link" data-bs-toggle="tab">reviews</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane show fade active" id="overview">
                                <div class="overview">
                                    {{-- <p>{{ $course->overview ?? }}</p> --}}
                                    {{-- <iframe width="900" height="506" src="https://www.youtube.com/embed/RXv_uIN6e-Y"
                                        title="10 Excel Formula used daily at WORK (Excel formula for job interview)"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen></iframe> --}}
                                    <p>{{ $course->overview ?? 'Not available' }}</p>
                                    <div class="details-buttons-area">
                                        @auth
                                            @if (!auth()->user()->courses->contains($course->id))
                                                @if (!$course->available_seats <= 0)
                                                    <div style="display: flex;flex-flow: column nowrap">


                                                        <form action="{{ route('courses.enroll', $course->id) }}"
                                                            method="POST">
                                                            <button class="custom-button theme-one">Enroll Now <svg
                                                                    style="margin-bottom: 3px"
                                                                    xmlns="http://www.w3.org/2000/svg" width="23"
                                                                    height="23" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="1.6"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <circle cx="9" cy="7" r="3.5" />
                                                                    <path d="M2.5 20v-1.5a6.5 6.5 0 0 1 13 0V20z" />
                                                                    <circle cx="18" cy="17" r="4" />
                                                                    <path d="M18 15v4M16 17h4" />
                                                                </svg></button>
                                                        </form>

                                                        <button style="margin-left: 20px" type="button"
                                                            id="open-course-support" class="course-support-trigger"
                                                            aria-haspopup="dialog" aria-controls="course-support-modal">
                                                            Need Support?
                                                        </button>

                                                        <div class="course-support-overlay" id="course-support-modal" hidden>
                                                            <section class="course-support-dialog" role="dialog"
                                                                aria-modal="true" aria-labelledby="course-support-title">

                                                                <form class="course-support-form" method="POST"
                                                                    action="{{ route('student.applications.store') }}">
                                                                    @csrf
                                                                    <input type="hidden" name="course_id"
                                                                        value="{{ $course->id }}">
                                                                    <input type="hidden" name="type"
                                                                        value="course_support">
                                                                    <div id="textareCounter">

                                                                        <x-textarea
                                                                            label="in Short ,Why You Need This Support ?"
                                                                            style="margin-top: 7px" id="support-message"
                                                                            rows="5" name="msg" required
                                                                            minlength="5" />
                                                                    </div>
                                                                    <button onclick="submit_review2(event)" type="submit"
                                                                        style="" class="custom-button theme-one">Send
                                                                        message</button>
                                                                </form>
                                                            </section>
                                                        </div>

                                                    </div>
                                                @else
                                                    <div
                                                        style="font-weight: bold;color: rgb(130, 0, 0);font-size: large;text-decoration: underline;">
                                                        No More Seats</div>
                                                @endif
                                            @else
                                                <div class="course-enrollment-status" role="status">Already enrolled</div>
                                            @endif
                                        @endauth
                                        @guest
                                            <p class="course-login-prompt">Sign in to enroll in this course.
                                                <a href="{{ route('login') }}">Sign in</a>
                                            </p>
                                        @endguest
                                        <ul class="social-icons">
                                            <li>
                                                <a href="#0" class="active"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="#0"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a href="#0"><i class="fa fa-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" role="tabpanel" id="curriculum">
                                <div class="overview">
                                    <div>{!! $course->curriculum ?? 'Not available' !!} </div>
                                    <div class="details-buttons-area">
                                        {{-- @dd(!auth()->user()->courses->contains($course->id)) --}}
                                        @auth
                                            @if (!auth()->user()->courses->contains($course->id))
                                                @if (!$course->available_seats <= 0)
                                                    <form action="{{ route('courses.enroll', $course->id) }}" method="POST">

                                                        <button class="custom-button theme-one">Enroll Now <svg
                                                                style="margin-bottom: 3px" xmlns="http://www.w3.org/2000/svg"
                                                                width="23" height="23" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="1.6"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <circle cx="9" cy="7" r="3.5" />
                                                                <path d="M2.5 20v-1.5a6.5 6.5 0 0 1 13 0V20z" />
                                                                <circle cx="18" cy="17" r="4" />
                                                                <path d="M18 15v4M16 17h4" />
                                                            </svg></button>
                                                    </form>
                                                @else
                                                    <div style="font-weight: bold;color: rgb(130, 0, 0);font-size: large;">
                                                        No More Seats</div>
                                                @endif
                                            @else
                                                <div class="course-enrollment-status" role="status">Already enrolled</div>
                                            @endif
                                        @endauth
                                        @guest
                                            <p class="course-login-prompt">Sign in to enroll in this course.
                                                <a href="{{ route('login') }}">Sign in</a>
                                            </p>
                                        @endguest
                                        <ul class="social-icons">
                                            <li>
                                                <a href="#0"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="#0"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a href="#0"><i class="fa fa-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="instructor">
                                @if (isset($course->instructor))
                                    <div class="overview text-center">
                                        <div class="instructor-item">
                                            <div id="ins-image-Counter" class="instructor-thumb">
                                                <a href="#0"><img id="ins-image"
                                                        src="{{ asset($course->instructor->personal_image) }}"
                                                        alt="instructor"></a>
                                            </div>
                                            <div class="instructor-content">
                                                <h6 class="title"><a
                                                        href="{{ route('instructors.show', $course->instructor->id) }}">{{ $course->instructor->name }}</a>
                                                </h6>
                                                <span class="details">{{ $course->instructor->major }}</span>
                                            </div>
                                        </div>
                                        <p>{{ $course->instructor->description }}</p>
                                        <div class="details-buttons-area">
                                            <ul class="social-icons justify-content-center w-100">
                                                <li>
                                                    <a href="#0"><i class="fa fa-facebook"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#0" class="active"><i class="fa fa-twitter"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#0"><i class="fa fa-instagram"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <hr>
                                @else
                                    <div style="font-size: 25px;text-align: center;margin: 40px 0px 20px 0px ">No
                                        instructor
                                        Yet !</div>
                                @endif


                            </div>
                            <div class="tab-pane fade" id="reviews">
                                <div class="client-review">
                                    <div class="review-comments">
                                        <h6 class="review-title">Reviews ({{ $course->reviews->count() }})</h6>
                                        <ul class="review-contents">
                                            @forelse ($course->reviews as $review)
                                                <li class="review-item-{{ $review->id }}" style="position: relative;">
                                                    <div class="thumb">
                                                        <img src="{{ asset($review->user->image) }}" alt="course">
                                                    </div>
                                                    <div class="cont" style="width: 100%;">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="subtitle">{{ $review->user->name }}</h6>

                                                            <!-- زر الحذف -->

                                                            @can('delete', $review)
                                                                <form action="{{ route('review.destroy', $review->id) }}"
                                                                    method="POST">
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-outline-danger"
                                                                        style="border: none; background: transparent; color: #dc3545;"
                                                                        title="Delete Review">
                                                                        <i class="fa fa-trash"></i> Delete
                                                                    </button>
                                                                </form>
                                                            @endcan
                                                        </div>

                                                        <div class="ratings cl-theme">

                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if ($i < $review->star_num)
                                                                    <span><i class="fa fa-star"></i></span>
                                                                @else
                                                                    <span><i class="fa fa-star"
                                                                            style="color: #eee"></i></span>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <p>{{ $review->content }}</p>
                                                    </div>
                                                </li>
                                                <hr>
                                                <br>
                                            @empty
                                                <div>No Review Yet</div>
                                            @endforelse
                                        </ul>
                                    </div>
                                    @auth
                                        <div class="review-form">
                                            <h6 class="review-title">Add a Review</h6>
                                            <form id="rev-form" action="{{ route('courses.review.store', $course->id) }}"
                                                method="POST" class="row client-form align-items-center">

                                                <div class="col-md-4 col-12">
                                                    <div class="rating">
                                                        <span class="rating-title">Your Rating : </span>
                                                        <ul class="ratings">
                                                            @for ($i = 0; $i <= 5; $i++)
                                                                <li>
                                                                    <a style="color: #eee" data-rating="{{ $i }}"
                                                                        href="#0" title="Give Me One Star"><i
                                                                            class="fa fa-star"></i></a>
                                                                </li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div id="text-area-countiner" class="col-md-12 col-12 ">
                                                    <x-textarea label="Your Comment :"
                                                        style="background-color: whitesmoke;height: 100%;" id="comment"
                                                        name="content" rows="5" placeholder="Type Here Comment" />
                                                </div>
                                                <div class="col-12">
                                                    <button onclick="submit_review(event)" type="submit"
                                                        class="custom-button rounded">Submit
                                                        Review</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-4 col-sm-4 col-xs-12">
                    <div class="course_features">
                        <h3>Course features</h3>
                        <ul>
                            <li><i class="fa fa-calendar"></i> Course duration
                                <b>{{ $course->duration ?? 'Not available' }}</b>
                            </li>
                            <li><i class="fa fa-user"></i> Total Lectures
                                <b>{{ $course->total_lectures ?? 'Not available' }}</b>
                            </li>
                            <li><i class="fa fa-user"></i> Total Students <b>{{ $course->students->count() }}</b></li>
                            <li><i class="fa fa-trophy"></i> Certification <b>{{ $course->certification }}</b></li>
                        </ul>
                    </div>
                    <div class="event_info_price">
                        @auth

                            @if (!auth()->user()->courses->contains($course->id))
                                @if (auth()->user()->hasRole('student'))
                                    <h4>Price - {{ $course->price }} $</h4>
                                @endif
                            @else
                                <div class="course-enrollment-status" role="status">Already enrolled</div>
                            @endif
                        @endauth
                        @guest
                            <h4>Price - {{ $course->price }} $</h4>

                        @endguest
                    </div>

                    <div class="related_course">
                        <h3>Related Course</h3>
                        @forelse ($related_courses as $related_course)
                            <div class="single_rc">
                                <div class="rc_img">
                                    {{-- @dd($related_course) --}}
                                    <img class="related-course-image" style="width: 80px;height: 82px;border-radius:6px "
                                        src="{{ asset($related_course->inner_image) }}" alt="" />
                                </div>
                                @for ($i = 0; $i <= $related_course->star_num; $i++)
                                    <span><i class="fa fa-star"></i></span>
                                @endfor

                                <h4><a title="{{ $related_course->title }}"
                                        style="text-overflow: ellipsis;overflow: hidden;text-wrap:nowrap; "
                                        href="{{ route('courses.show', $related_course->id) }}">{{ $related_course->title }}</a>
                                </h4>
                                @auth
                                    @if (!auth()->user()->courses->contains($related_course->id))
                                        <span>{{ $related_course->price }} $</span>
                                    @else
                                        <div class="course-enrollment-status" role="status">Already enrolled</div>
                                    @endif

                                @endauth
                                @guest
                                    <span>{{ $related_course->price }} $</span>

                                @endguest
                            </div><!--- END SINGLE RELATED COURSE -->
                        @empty
                            <div>No Related Course</div>
                        @endforelse
                    </div><!--- END RELATED COURSE -->
                    <div class="sidebar-post">
                        <div class="sidebar_title">
                            <h4>Tags</h4>
                        </div>
                        <div class="single_category">
                            <ul>
                                @forelse ($course->tags as $tag)
                                    <li><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}
                                            <sup>{{ $tag->courses->count() }}</sup></a>
                                    </li>

                                @empty
                                    <div>No Tags AVILABLE</div>
                                @endforelse

                            </ul>
                        </div><!-- END SOCIAL MEDIA POST -->
                    </div><!-- END SIDEBAR POST -->
                    <div class="sidebar-post">
                        <div class="sidebar_title">
                            <h4>Follow us</h4>
                        </div>
                        <div class="single_social">
                            <ul>
                                <li>
                                    <div class="social_item b_facebook"><a href="#" title="facebook"><i
                                                class="fa fa-facebook"></i><span class="item-list">150K Likes</span></a>
                                    </div>
                                </li>

                                <li>
                                    <div class="social_item b_twitter"><a href="#" title="twitter"><i
                                                class="fa fa-twitter"></i><span class="item-list">138K
                                                Followers</span></a></div>
                                </li>

                                <li>
                                    <div class="social_item b_youtube"><a href="#" title="youtube"><i
                                                class="fa fa-youtube"></i><span class="item-list">90K
                                                Subscribers</span></a></div>
                                </li>

                                <li>
                                    <div class="social_item b_pinterest"><a href="#" title="pinterest"><i
                                                class="fa fa-pinterest"></i><span class="item-list">350K
                                                Followers</span></a></div>
                                </li>

                                <li>
                                    <div class="social_item b_tumblr"><a href="#" title="rss"><i
                                                class="fa fa-tumblr"></i><span class="item-list">901 Followers</span></a>
                                    </div>
                                </li>

                                <li>
                                    <div class="social_item b_rss"><a href="#" title="rss"><i
                                                class="fa fa-rss"></i><span class="item-list">411 Followers</span></a>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- END SOCIAL MEDIA POST -->
                    </div><!-- END SIDEBAR POST -->
                </div><!--- END COL -->
            </div><!-- END ROW -->
        </div><!-- END CONTAINER -->
    </section>
    <!-- END COURSE -->
    {{-- <input type="hidden"> --}}
@endsection()

@section('JS')


    <script>
        const supportModal = document.querySelector('#course-support-modal');
        const supportOpenButton = document.querySelector('#open-course-support');
        const supportCloseButton = supportModal?.querySelector('.course-support-close');

        function closeCourseSupportModal() {
            if (supportModal) {
                supportModal.hidden = true;
                supportOpenButton?.focus();
            }
        }

        supportOpenButton?.addEventListener('click', () => {
            supportModal.hidden = false;
            supportModal.querySelector('#support-name')?.focus();
        });

        supportCloseButton?.addEventListener('click', closeCourseSupportModal);
        supportModal?.addEventListener('click', event => {
            if (event.target === supportModal) {
                closeCourseSupportModal();
            }
        });
        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' && supportModal && !supportModal.hidden) {
                closeCourseSupportModal();
            }
        });

        document.querySelectorAll('.ratings a').forEach(star => {

            star.addEventListener('click', function(e) {

                e.preventDefault();

                let rating = this.dataset.rating;
                console.log(rating);
            });
        });

        let rates = document.querySelectorAll('.ratings a');
        let rating = 0;
        rates.forEach(star => {

            star.addEventListener('click', function(e) {

                e.preventDefault();

                rating = this.dataset.rating;

                document.querySelectorAll('.ratings a').forEach(item => {
                    item.classList.remove('active');
                });

                document.querySelectorAll('.ratings a').forEach(item => {

                    if (item.dataset.rating <= rating) {
                        item.classList.add('active');
                    }

                });
                let hiddenIn = document.createElement("input");
                hiddenIn.type = "hidden";
                hiddenIn.value = rating;
                hiddenIn.name = "star_num";
                document.querySelector("#rev-form").appendChild(hiddenIn);

                console.log(hiddenIn);
            });

        });




        let textareaCounter = document.querySelector("#text-area-countiner");
        let textarea_Counter = document.querySelector("#textareCounter");
        let error = document.createElement("p");
        error.style.color = "red";
        error.style.fontSize = "small";
        error.style.padding = "0%";
        error.style.margin = "0%";
        error.style.marginBottom = "10px";
        error.textContent = "This Field Must Be More Than 5 Lattars";
        let review_content = document.querySelectorAll("textarea");

        function submit_review(event) {
            console.log(review_content[1].value.length);

            if (review_content[1].value.length <= 6) {
                event.preventDefault();
                if (!textareaCounter.contains(error)) {
                    textareaCounter.appendChild(error);



                }
                review_content[1].style.marginBottom = "0%";
                review_content[1].style.border = "1px solid red";
            }

        }






        function submit_review2(event) {
            console.log(review_content[0].value.length);

            if (review_content[0].value.length <= 6) {
                event.preventDefault();
                if (!textarea_Counter.contains(error)) {
                    textarea_Counter.appendChild(error);



                }
                review_content[0].style.marginBottom = "0%";
                review_content[0].style.border = "1px solid red";
            }

        }

        // function submit_review(event, course_id) {
        //     console.log(review_content+"Sdddd");
        //     fetch(`/courses/${course_id}/review`, {
        //         method: "POST",
        //         headers: {
        //             "Content-Type": "application/json",
        //             "X-CSRF-TOKEN": "{{ csrf_token() }}",
        //             "Accept": "application/json",
        //             // "X-CSRF-TOKEN":document.querySelector(meta[name="csrf-token"].content)
        //         },
        //         body: JSON.stringify({
        //             "content": review_content,
        //             "star_num": rating
        //         })

        //     }).then((result) => {

        //     }).catch((err) => {
        //         console.log(error.response?.status);
        //         console.log(error.response?.data);
        //     });
        // }
    </script>


@endsection
