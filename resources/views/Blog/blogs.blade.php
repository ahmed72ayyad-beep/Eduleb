@extends('layouts.website')
@section('title', 'Eduleb - Blog ')
@section('CSS')
    <style>
        .blogs-grid>[class*="col-"] {
            display: flex;
        }

        .blogs-grid .single_blog {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .blog-image-frame {
            aspect-ratio: 16 / 9;
            overflow: hidden;
        }

        .blog-image-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blogs-grid .content_box {
            display: flex;
            flex: 1;
            flex-direction: column;
        }

        .blogs-grid .blog-read-more {
            align-self: flex-start;
            margin-top: auto;
        }
    </style>
@endsection
@section('content')
    {{-- @dd($blogs) --}}
    <!-- START SECTION TOP -->
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <h1>Our Blog</h1>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li> / Blog</li>
                    </ul>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->

    <!-- START BLOG -->
    <section id="blog" class="blog_area section-padding">
        <div class="container">
            <div class="row blogs-grid">
                @forelse ($blogs as $blog)
                    {{-- @dd($blog->tags) --}}
                    <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                        data-wow-offset="0">
                        <div class="single_blog">
                            <div class="blog-image-frame">
                                <img src="{{ filled($blog->image) ? asset($blog->image) : asset('assets/img/blog/1.jpg') }}"
                                    class="img-fluid" alt="{{ $blog->title }}" />
                            </div>
                            <div class="content_box">
                                <span>{{ $blog->created_at->diffForHumans() }} |
                                    @if ($blog->tags->first() != null)
                                        <a
                                            href="{{ route('tags.show', $blog->tags->first()->id) }}">{{ $blog->tags->first()->name }}</a>
                                    @else
                                        #######
                                    @endif


                                </span>
                                <h2><a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a></h2>
                                <a class="btn_one blog-read-more" href="{{ route('blogs.show', $blog->id) }}">Read More <i
                                        class="ti-arrow-top-right"></i></a>
                            </div>
                        </div>
                    </div><!-- END COL-->
                @empty
                    <div style="font-size:35px " class="font-semibold text-center">No Blogs Yet !</div>
                @endforelse
            </div><!-- / END ROW -->
        </div><!-- END CONTAINER  -->
    </section>
    <!-- END BLOG -->
@endsection()
