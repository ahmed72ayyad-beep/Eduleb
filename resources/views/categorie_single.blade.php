@extends('layouts.website')
@section('title', 'Eduleb - Categories')
@section('content')

    <!-- START SECTION TOP -->
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <h1 class="mb-4">Category Courses " {{ $tag->name }} "</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li> / Category</li>
                    </ul>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->

    <!-- START CATEGORY COURSES -->
    <section class="home_course section-padding">

        <!-- قسم الكورسات -->
        <div class="container">

            <!-- إضافة عنوان قسم الكورسات -->
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="font-weight-bold" style="font-size: 40px;">Related Courses</h2>
                </div>
            </div>
            <!-- نهاية العنوان -->

            <div class="row">
                @if ($tag->courses->count() > 0 || $courses->count() > 0)

                    @foreach ($tag->courses as $course)
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <div class="single_course">
                                <div class="single_c_img">
                                    <img src="{{ asset($course->outer_image) ?? asset('assets/img/course/4.png') }}"
                                        class="img-fluid" alt="course-image" />
                                    <span
                                        style="bottom: none !important;top: none;">{{ $course->type ?? 'Eduction' }}</span>
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
                    @endforeach
                    @foreach ($courses as $course)
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <div class="single_course">
                                <div class="single_c_img">
                                    <img src="{{ asset($course->outer_image) ?? asset('assets/img/course/4.png') }}"
                                        class="img-fluid" alt="course-image" />
                                    <span
                                        style="bottom: none !important;top: none;">{{ $course->type ?? 'Eduction' }}</span>
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
                    @endforeach
                @else
                    <div style="font-size:30px" class="col-12 font-semibold text-center p-12">No Related Courses Found
                        in
                        This Category!</div>
                @endif
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->

        <!-- مسافة فاصلة بين القسمين -->
        <div class="mt-5 mb-5">
            <hr>
        </div>

        <!-- قسم المنشورات -->
        <div class="container">

            <!-- إضافة عنوان قسم المنشورات -->
            <div class="row mb-5 mt-4">
                <div class="col-12 text-center">
                    <h2 class="font-weight-bold" style="font-size: 40px;">Related Blogs</h2>
                </div>
            </div>
            <!-- نهاية العنوان -->

            <div class="row">
                @if ($tag->blogs->count() > 0 || $blogs->count() > 0)

                    @foreach ($tag->blogs as $blog)
                        <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                            data-wow-offset="0">
                            <div class="single_blog">
                                <img src="{{ asset($blog->image) }}" class="img-fluid" alt="image" />
                                <div class="content_box">
                                    <span>{{ $blog->created_at->diffForHumans() }} |
                                        @if ($blog->tags->first() != null)
                                            <span>{{ $blog->tags->first()->name }}</span>
                                        @else
                                            #######
                                        @endif
                                    </span>
                                    <h2><a href="href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a>
                                    </h2>
                                    <a class="btn_one" href="{{ route('blogs.show', $blog->id) }}">Read More <i
                                            class="ti-arrow-top-right"></i></a>
                                </div>
                            </div>
                        </div><!-- END COL-->
                    @endforeach
                    @foreach ($blogs as $blog)
                        {{-- @dd($blog->tags) --}}
                        <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                            data-wow-offset="0">
                            <div class="single_blog">
                                <img src="{{ asset($blog->image) }}" class="img-fluid" alt="image" />
                                <div class="content_box">
                                    <span>{{ $blog->created_at->diffForHumans() }} |
                                        @if ($blog->tags->first() != null)
                                            <span>{{ $blog->tags->first()->name }}</span>
                                        @else
                                            #######
                                        @endif
                                    </span>
                                    <h2><a href="href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a>
                                    </h2>
                                    <a class="btn_one" href="{{ route('blogs.show', $blog->id) }}">Read More <i
                                            class="ti-arrow-top-right"></i></a>
                                </div>
                            </div>
                        </div><!-- END COL-->
                    @endforeach
                @else
                    <div style="font-size:30px" class="col-12 font-semibold text-center">No Related Blogs Found in This
                        Category!</div>
                @endif
            </div><!-- / END ROW -->
        </div><!-- END CONTAINER  -->

    </section>
    <!-- END CATEGORY COURSES -->

@endsection()
