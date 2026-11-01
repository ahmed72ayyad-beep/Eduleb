@extends('layouts.website')
@section('title', "Eduleb - Blog $blog->title ")
@section('CSS')
    <style>
        .blog-single-page {
            background: #f6f7fc;
        }

        .blog-single-page .blog-page {
            padding: 72px 0 84px;
        }

        .blog-article-card,
        .blog-single-page .sidebar-post,
        .blog-single-page .single_author,
        .blog-single-page .single_comment {
            overflow: hidden;
            border: 1px solid #e8eaf3;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 10px 28px rgba(26, 45, 98, .06);
        }

        .blog-article-image {
            position: relative;
            overflow: hidden;
            aspect-ratio: 16 / 9;
            background: #e9edf7;
        }

        .blog-article-image img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .blog-article-content {
            padding: 34px 38px 38px;
        }

        .blog-article-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
            color: #697386;
            font-size: 13px;
        }

        .blog-article-meta__tag {
            display: inline-block;
            padding: 5px 11px;
            border-radius: 999px;
            background: #eef0ff;
            color: #525fe1;
            font-weight: 700;
            text-decoration: none;
        }

        .blog-article-title {
            margin: 0 0 20px;
            color: #1a2d62;
            font-size: clamp(28px, 3.2vw, 40px);
            font-weight: 700;
            line-height: 1.2;
        }

        .blog-article-body {
            color: #4b5565;
            font-size: 16px;
            line-height: 1.85;
            overflow-wrap: anywhere;
        }

        .blog-single-page .share_sp {
            margin: 0;
            padding: 24px 38px;
            border-top: 1px solid #eef0f6;
        }

        .blog-single-page .share_sp h4 {
            margin-bottom: 14px;
            color: #1a2d62;
            font-size: 16px;
        }

        .blog-single-page .share_sp ul {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .blog-single-page .share_sp ul li {
            float: none;
        }

        .blog-single-page .share_sp ul li a {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin: 0;
            padding: 9px 13px;
            border-radius: 6px;
            font-size: 13px;
        }

        .blog-single-page .author_part {
            margin-top: 38px;
        }

        .blog-single-page .single_author {
            padding: 28px;
        }

        .blog-single-page .author_part img {
            width: 88px;
            height: 88px;
            margin: 0 18px 12px 0;
            border: 3px solid #eef0ff;
            object-fit: cover;
        }

        .blog-single-page .author_part h4 {
            color: #1a2d62;
            text-transform: none;
            letter-spacing: 0;
        }

        .blog-single-page .comments_part {
            margin-top: 38px;
        }

        .blog-single-page .single_comment {
            padding: 24px;
        }

        .blog-single-page .single_comment img {
            width: 64px;
            height: 64px;
            margin: 0 16px 10px 0;
            border: 2px solid #eef0ff;
            object-fit: cover;
        }

        .blog-single-page .single_comment h4 {
            color: #1a2d62;
            text-transform: none;
            letter-spacing: 0;
        }

        .blog-single-page .sidebar-post {
            padding: 26px;
        }

        .blog-single-page .sidebar_title h4 {
            color: #1a2d62;
            font-size: 15px;
        }

        .blog-single-page .single_popular {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 16px;
        }

        .blog-single-page .single_popular:last-child {
            margin-bottom: 0;
        }

        .blog-single-page .single_popular > a {
            display: block;
            flex: 0 0 88px;
            width: 88px;
            height: 68px;
            overflow: hidden;
            border-radius: 7px;
            background: #e9edf7;
        }

        .blog-single-page .single_popular > a img {
            display: block;
            width: 100%;
            height: 100%;
            margin: 0;
            object-fit: cover;
            transition: transform .25s ease;
        }

        .blog-single-page .single_popular > a:hover img {
            transform: scale(1.06);
        }

        .blog-single-page .single_popular h5 {
            margin: 0;
            line-height: 1.4;
        }

        .blog-single-page .single_popular h5 a {
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }

        .blog-single-page .sidebar-banner a {
            display: block;
            overflow: hidden;
            border-radius: 8px;
            background: #e9edf7;
        }

        .blog-single-page .sidebar-banner img {
            display: block;
            width: 100%;
            height: auto;
        }

        .blog-single-page .tag a {
            text-decoration: none;
        }

        @media (max-width: 767.98px) {
            .blog-single-page .blog-page {
                padding: 44px 0 60px;
            }

            .blog-article-content {
                padding: 26px 22px 28px;
            }

            .blog-single-page .share_sp {
                padding: 22px;
            }

            .blog-single-page .single_author,
            .blog-single-page .single_comment {
                padding: 22px;
            }

            .blog-single-page .sidebar-post {
                padding: 22px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .blog-single-page *,
            .blog-single-page *::before,
            .blog-single-page *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
@endsection
@section('content')
    {{-- @dd($blog->content) --}}
    <!--SECTION TOP -->

    <!-- START BLOG -->
    <main class="blog-single-page">
        <section class="blog-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-sm-12 col-xs-12">
                        <div class="arti_single">
                            <div class="blog-article-card">
                                <div class="blog-article-image">
                                    <img src="{{ filled($blog->image) ? asset($blog->image) : asset('assets/img/blog/1.jpg') }}"
                                        alt="{{ $blog->title }}" fetchpriority="high" />
                                </div>
                                <article class="blog-article-content">
                                    <div class="blog-article-meta">
                                        <span>{{ $blog->created_at->format('F j, Y') }}</span>
                                        @if ($blog->tags->first() !== null)
                                            <a class="blog-article-meta__tag"
                                                href="{{ route('tags.show', $blog->tags->first()->id) }}">
                                                {{ $blog->tags->first()->name }}
                                            </a>
                                        @endif
                                        @role("admin")
                                        <span style="background-color: #eee; padding:5px 10px;border-radius: 20px">State : <span style="color:red">{{ $blog->status }}</span></span>
                                        @endrole
                                    </div>
                                    <h1 class="blog-article-title">{{ $blog->title }}</h1>
                                    {{-- @foreach ($blog->content as $content) --}}
                                    <div class="blog-article-body">
                                        <p>{{ $blog->content }}</p>
                                    </div>
                                    {{-- @endforeach --}}
                                </article>

                                <div class="share_sp">
                                    <h4>Share</h4>
                                    <ul>
                                        <li><a href="#"><span class="ti-facebook"></span> Facebook</a></li>
                                        <li><a href="#"><span class="ti-twitter"></span> Twitter</a></li>
                                        <li><a href="#"><span class="ti-instagram"></span> Instagram</a></li>
                                        <li><a href="#"><span class="ti-linkedin"></span> Linkedin</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- END ARTI SINGLE  -->
                        <div class="author_part">
                            <h3 class="blog_head_title">About the author</h3>
                            <div class="single_author">
                                <img src="{{ filled($blog->author->image) ? asset($blog->author->image) : asset('assets/img/blog/author.jpg') }}"
                                    alt="{{ $blog->author->name }}" loading="lazy" />
                                <h4>{{ $blog->author->name }}</h4>
                                <p>{{ $blog->author->description }}</p>
                            </div>
                        </div><!--- END AUTHOR PART -->
                        <div class="comments_part">
                            <h3 class="blog_head_title">Comments</h3>
                            @forelse ($comments as $comment)
                                <div class="single_comment">
                                    <img src="{{ filled($comment->user->image) ? asset($comment->user->image) : asset('assets/img/blog/author.jpg') }}"
                                        alt="{{ $comment->user->name }}" loading="lazy" />
                                    <h4>{{ $comment->user->name }}</h4>
                                    <p>{{ $comment->content }}</p>
                                </div><!--- END SINGLE COMMENT -->

                            @empty
                            @endforelse
                            <div>{{ $comments->links() }}</div>
                        </div><!--- END COMMENTS PART -->

                        @auth
                            <div class="comment_form">
                                <h3 class="blog_head_title" style="margin-bottom: 4px">Add a Comment</h3>
                                <div class="contact comment-box">
                                    <form action="{{ route('blogs.comments.store', $blog->id) }}" id="contact-form" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <x-textarea id="textarea" name="content" rows="5"
                                                    placeholder="Type Here Comment" style="padding-top:15px;"
                                                    class="form-control" />
                                            </div>
                                            <div class="col-md-12">
                                                <div class="actions">
                                                    <button type="submit" value="Send message" name="submit" id="submitButton"
                                                        class="btn btn_one" title="Submit Your Message!">Submit Comment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!--- END COMMENT FORM -->
                        @endauth
                    </div><!-- END COL-->
                    <div class="col-lg-5 col-sm-12 col-xs-12">
                    {{-- <div class="sidebar-post">
                        <div class="blog_search">
                            <input type="text" class="form-control" placeholder="Type & Press Enter">
                        </div>
                    </div><!-- END SINGLE POST --> --}}
                    {{-- <div class="sidebar-post">
                        <div class="newsletter-form">
                            <h4>Subscribe for get updates</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies quam nisi my
                                business</p>
                            <form action="#" class="subscribe">
                                <input type="text" class="subscribe__input" placeholder="Email Address">
                                <button type="button" class="sub_btn">Subscribe</button>
                            </form>
                        </div>
                    </div><!-- END SINGLE POST --> --}}
                        <div class="sidebar-post">
                        <div class="sidebar_title">
                            <h4>Popular post</h4>
                        </div>

                        @forelse ($popular_blogs as $popular_blog)
                            <div class="single_popular">
                                <a href="{{ route('blogs.show', $popular_blog->id) }}">
                                    <img src="{{ filled($popular_blog->image) ? asset($popular_blog->image) : asset('assets/img/blog/1.jpg') }}"
                                        alt="{{ $popular_blog->title }}" loading="lazy" />
                                </a>
                                <h5><a href="{{ route('blogs.show', $popular_blog->id) }}"
                                        class="hover:text-blue-700 font">{{ $popular_blog->sub_title }}</a>
                                </h5>
                            </div><!-- END SINGLE POPULAR POST -->

                        @empty
                            <div>No Suggestions Yet</div>
                        @endforelse
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
                    {{-- <div class="sidebar-post">
                        <div class="sidebar_title">
                            <h4>CATEGORIES</h4>
                        </div>
                        <div class="single_category">
                            <ul>
                                <li><a href="#">Education <sup>11</sup></a></li>
                                <li><a href="#">Ai Content <sup>44</sup></a></li>
                                <li><a href="#">New Course <sup>33</sup></a></li>
                                <li><a href="#">Marketing <sup>14</sup></a></li>
                                <li><a href="#">Software <sup>21</sup></a></li>
                                <li><a href="#">Design <sup>01</sup></a></li>
                            </ul>
                        </div><!-- END SOCIAL MEDIA POST -->
                    </div><!-- END SIDEBAR POST --> --}}
                        <div class="sidebar-post">
                        <div class="tag">
                            <div class="sidebar_title">
                                <h4>Popular Tag</h4>
                            </div>
                            @forelse ($blog->tags as $tag)
                                <a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a>

                            @empty
                                <div>No Tags </div>
                            @endforelse

                        </div>
                        </div>
                        <div class="sidebar-post">
                        <div class="sidebar_title">
                            <h4>Ad Banner</h4>
                        </div>
                        <div class="sidebar-banner">
                            <a href="#"><img src="{{ asset('assets/img/blog/banner.jpg') }}" class="img-fluid"
                                    alt="" /></a>
                        </div><!-- END SOCIAL MEDIA POST -->
                        </div><!-- END SIDEBAR POST -->
                    </div><!--- END COL -->
                </div><!-- END ROW-->
            </div><!-- END CONTAINER-->
        </section>
    </main>
    <!-- END BLOG -->
@endsection()
