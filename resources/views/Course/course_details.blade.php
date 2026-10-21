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
                        <img alt="" class="img-fluid" src="{{ asset($course->inner_image) }}" />
                        <div class="single_event_text_single">
                            <h4>{{ $course->title }}</h4>
                            <span><i class="fa fa-calendar"></i>{{ $course->date ?? 'Recorded Course' }}</span>
                            <span><i class="fa fa-clock-o"></i>{{ $course->duration ?? 'Not available' }}</span>
                            <span><i class="fa fa-table"></i><strong>{{ $course->available_seats ?? 'Not available' }} Seats
                                    Available</strong></span>
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

                                        @if (!auth()->user()->courses->contains($course->id))
                                            <form action="{{ route('courses.enroll', $course->id) }}" method="POST">

                                                <button class="custom-button theme-one">Enroll Now <svg
                                                        style="margin-bottom: 3px" xmlns="http://www.w3.org/2000/svg"
                                                        width="23" height="23" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <circle cx="9" cy="7" r="3.5" />
                                                        <path d="M2.5 20v-1.5a6.5 6.5 0 0 1 13 0V20z" />
                                                        <circle cx="18" cy="17" r="4" />
                                                        <path d="M18 15v4M16 17h4" />
                                                    </svg></button>
                                            </form>
                                        @else
                                            <div
                                                style="font-weight: bold;color: rgb(130, 0, 0);font-size: large;text-decoration: underline;">
                                                Already Enrolled</div>
                                        @endif
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
                                    <p>{{ $course->curriculum ?? 'Not available' }} </p>
                                    <div class="details-buttons-area">
                                        {{-- @dd(!auth()->user()->courses->contains($course->id)) --}}
                                        @if (!auth()->user()->courses->contains($course->id))
                                            <form action="{{ route('courses.enroll', $course->id) }}" method="POST">

                                                <button class="custom-button theme-one">Enroll Now <svg
                                                        style="margin-bottom: 3px" xmlns="http://www.w3.org/2000/svg"
                                                        width="23" height="23" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <circle cx="9" cy="7" r="3.5" />
                                                        <path d="M2.5 20v-1.5a6.5 6.5 0 0 1 13 0V20z" />
                                                        <circle cx="18" cy="17" r="4" />
                                                        <path d="M18 15v4M16 17h4" />
                                                    </svg></button>
                                            </form>
                                        @else
                                            <div style="font-weight: bold;color: rgb(130, 0, 0);font-size: large;">Already
                                                Enrolled</div>
                                        @endif
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
                                                        href="{{ route('instractors.show', $course->instructor->id) }}">{{ $course->instructor->name }}</a>
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
                                                            @for ($i = 0; $i <= $review->star_num; $i++)
                                                                <span><i class="fa fa-star"></i></span>
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
                                                                <a data-rating="{{ $i }}" href="#0"
                                                                    title="Give Me One Star"><i
                                                                        class="fa fa-star"></i></a>
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                </div>
                                            </div>
                                            <div id="text-area-countiner" class="col-md-12 col-12 ">
                                                <x-textarea id="textarea" name="content" rows="5"
                                                    placeholder="Type Here Comment" />
                                            </div>
                                            <div class="col-12">
                                                <button onclick="submit_review(event,{{ $course->id }})" type="submit"
                                                    class="custom-button rounded">Submit
                                                    Review</button>
                                            </div>
                                        </form>
                                    </div>
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
                        @if (!auth()->user()->courses->contains($course->id))
                            @if (auth()->user()->hasRole('student'))
                                <h4>Price - {{ $course->price }}</h4>
                            @endif
                        @else
                            <div
                                style="font-weight: bold;color: rgb(130, 0, 0);font-size: large;text-decoration: underline;text-align: center">
                                Already Enrolled</div>
                        @endif
                    </div>

                    <div class="related_course">
                        <h3>Related Course</h3>
                        @forelse ($related_courses as $related_course)
                            <div class="single_rc">
                                <div class="rc_img">
                                    {{-- @dd($related_course) --}}
                                    <img style="width: 80px;height: 82px;border-radius:6px "
                                        src="{{ asset($related_course->inner_image) }}" alt="" />
                                </div>
                                @for ($i = 0; $i <= $related_course->star_num; $i++)
                                    <span><i class="fa fa-star"></i></span>
                                @endfor

                                <h4><a title="{{ $related_course->title }}"
                                        style="text-overflow: ellipsis;overflow: hidden;text-wrap:nowrap; "
                                        href="{{ route('courses.show', $related_course->id) }}">{{ $related_course->title }}</a>
                                </h4>
                                @if (!auth()->user()->courses->contains($course->id))
                                    @if (auth()->user()->hasRole('student'))
                                        <span>{{ $related_course->price }} $</span>
                                    @endif
                                @else
                                    <div
                                        style="font-weight: bold;color: rgb(130, 0, 0);font-size: large;text-decoration: underline;text-align: center">
                                        Already Enrolled</div>
                                @endif
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
                                    <li><a href="{{ route("tags.show",$tag->id) }}">{{ $tag->name }} <sup>{{ $tag->courses->count() }}</sup></a>
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
        let error = document.createElement("p");
        error.style.color = "red";
        error.style.fontSize = "small";
        error.style.padding = "0%";
        error.style.margin = "0%";
        error.style.marginBottom = "10px";
        error.textContent = "This Field Must Filled";



        function submit_review(event) {
            let review_content = document.querySelector("textarea");
            if (review_content.value.length < 1) {
                event.preventDefault();
                textareaCounter.appendChild(error);
                review_content.style.marginBottom = "0%";
                review_content.style.border = "1px solid red";
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
