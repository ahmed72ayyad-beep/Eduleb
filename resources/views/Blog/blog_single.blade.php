@extends('layouts.website')
@section('title', "Eduleb - Blog $blog->title ")
@section('content')
    {{-- @dd($blog->content) --}}
    <!--SECTION TOP -->
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <h1>Single Blog</h1>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li> / Single Blog</li>
                    </ul>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->

    <!-- START BLOG -->
    <section class="blog-page section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-sm-12 col-xs-12">
                    <div class="arti_single">
                        <div class="arti_img_two">
                            <img src="{{ asset($blog->image) }}" class="img-fluid" alt="Blog image" />
                        </div>
                        <div class="arti_content ">
                            {{-- @foreach ($blog->content as $content) --}}
                            <p>{{ $blog->content }}</p>
                            <br>
                            {{-- @endforeach --}}
                        </div>

                        <div class="share_sp">
                            <h4>Share</h4>
                            <ul>
                                <li><a href="#"><span class="ti-facebook"></span> Facebook</a></li>
                                <li><a href="#"><span class="ti-twitter"></span> Twitter</a></li>
                                <li><a href="#"><span class="ti-instagram"></span> Instagram</a></li>
                                <li><a href="#"><span class="ti-linkedin"></span> Linkedin</a></li>
                            </ul>
                        </div>
                    </div><!-- END ARTI SINGLE  -->
                    <div class="author_part">
                        <h3 class="blog_head_title">About the author</h3>
                        <div class="single_author">
                            <img src="{{ asset($blog->author->image) }}" alt="" />
                            <h4>{{ $blog->author->name }}</h4>
                            <p>{{ $blog->author->description }}</p>
                        </div>
                    </div><!--- END AUTHOR PART -->
                    <div class="comments_part">
                        <h3 class="blog_head_title">Comments</h3>
                        @forelse ($comments as $comment)
                            <div class="single_comment">
                                <img src="{{ asset($comment->user->image) }}" alt="" />
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
                                <a href="{{ route('blogs.show', $popular_blog->id) }}"><img
                                        src="{{ asset($popular_blog->image) }}" alt="" /></a>
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
    <!-- END BLOG -->
@endsection()
