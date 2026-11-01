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

        .blogs-hero {
            position: relative;
            overflow: hidden;
            padding: 150px 0 88px;
            background:
                radial-gradient(circle at 82% 18%, rgba(255, 255, 255, .13), transparent 25%),
                linear-gradient(110deg, rgba(20, 33, 81, .94), rgba(82, 95, 225, .82)),
                url('{{ asset('assets/img/bg/section-top.jpg') }}') center / cover;
        }

        .blogs-hero__eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 15px;
            color: #d7dcff;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .blogs-hero__eyebrow i {
            font-size: 16px;
        }

        .blogs-hero__title {
            max-width: 720px;
            margin: 0 0 16px;
            color: #fff;
            font-size: clamp(40px, 5vw, 60px);
            font-weight: 700;
            line-height: 1.1;
        }

        .blogs-hero__description {
            max-width: 650px;
            margin: 0;
            color: rgba(255, 255, 255, .84);
            font-size: 17px;
            line-height: 1.7;
        }

        .blogs-hero__actions {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-top: 28px;
        }

        .blogs-hero__button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 22px;
            border: 1px solid #fff;
            border-radius: 6px;
            background: #fff;
            color: #1a2d62;
            font: inherit;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .blogs-hero__button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .18);
            color: #1a2d62;
        }

        .blogs-hero__button--secondary {
            border-color: rgba(255, 255, 255, .65);
            background: rgba(255, 255, 255, .1);
            color: #fff;
        }

        .blogs-hero__button--secondary:hover {
            background: #fff;
            color: #1a2d62;
        }

        .blog-post-modal[hidden] {
            display: none !important;
        }

        .blog-post-modal {
            position: fixed;
            z-index: 1100;
            inset: 0;
            display: grid;
            overflow-y: auto;
            padding: 24px;
            place-items: center;
            background: rgba(15, 23, 42, .68);
        }

        .blog-post-modal-open {
            overflow: hidden;
        }

        .blog-post-modal__panel {
            width: min(100%, 680px);
            max-height: min(90vh, 900px);
            overflow-y: auto;
            border: 1px solid #e8eaf3;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 24px 70px rgba(0, 0, 0, .24);
        }

        .blog-post-modal__header,
        .blog-post-modal__footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 22px 26px;
        }

        .blog-post-modal__header {
            border-bottom: 1px solid #eef0f6;
        }

        .blog-post-modal__eyebrow {
            margin: 0 0 5px;
            color: #525fe1;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .blog-post-modal__title {
            margin: 0;
            color: #1a2d62;
            font-size: 25px;
            font-weight: 700;
        }

        .blog-post-modal__close {
            display: grid;
            flex: 0 0 40px;
            width: 40px;
            height: 40px;
            place-items: center;
            border: 0;
            border-radius: 50%;
            background: #f1f3f9;
            color: #1a2d62;
            cursor: pointer;
            font-size: 22px;
        }

        .blog-post-modal__close:hover {
            background: #e6e9f4;
        }

        .blog-post-modal__form {
            padding: 24px 26px 26px;
        }

        .blog-post-modal__grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .blog-post-modal__field {
            min-width: 0;
        }

        .blog-post-modal__field--full {
            grid-column: 1 / -1;
        }

        .blog-post-modal__label {
            display: block;
            margin-bottom: 7px;
            color: #28304e;
            font-size: 14px;
            font-weight: 600;
        }

        .blog-post-modal__input,
        .blog-post-modal__textarea {
            display: block;
            width: 100%;
            min-height: 46px;
            padding: 10px 12px;
            border: 1px solid #d9deea;
            border-radius: 6px;
            background: #fff;
            color: #20243a;
            font: inherit;
        }

        .blog-post-modal__textarea {
            min-height: 150px;
            resize: vertical;
        }

        .blog-post-modal__input:focus,
        .blog-post-modal__textarea:focus {
            border-color: #525fe1;
            outline: 0;
            box-shadow: 0 0 0 3px rgb(82 95 225 / 13%);
        }

        .blog-post-modal__help {
            margin: 7px 0 0;
            color: #697386;
            font-size: 12px;
        }

        .blog-post-modal__error {
            margin: 6px 0 0;
            color: #b42318;
            font-size: 13px;
        }

        .blog-post-modal__tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .blog-post-modal__tag-group {
            min-width: 0;
            margin: 0;
            padding: 0;
            border: 0;
        }

        .blog-post-modal__tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 11px;
            border: 1px solid #e8eaf3;
            border-radius: 6px;
            background: #f8f9fc;
            color: #404b63;
            font-size: 13px;
        }

        .blog-post-modal__tag input {
            accent-color: #525fe1;
        }

        .blog-post-modal__footer {
            justify-content: flex-end;
            border-top: 1px solid #eef0f6;
        }

        .blog-post-modal__cancel,
        .blog-post-modal__submit {
            min-height: 44px;
            padding: 10px 18px;
            border-radius: 6px;
            font: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .blog-post-modal__cancel {
            border: 1px solid #d9deea;
            background: #fff;
            color: #404b63;
        }

        .blog-post-modal__submit {
            border: 1px solid #525fe1;
            background: #525fe1;
            color: #fff;
        }

        .blog-post-modal__submit:hover {
            border-color: #414dd0;
            background: #414dd0;
        }

        .blogs-hero__count {
            color: rgba(255, 255, 255, .9);
            font-size: 14px;
        }

        .blogs-hero__count strong {
            color: #fff;
            font-size: 18px;
        }

        .blogs-hero__breadcrumb {
            margin-top: 28px;
            color: rgba(255, 255, 255, .72);
            font-size: 14px;
        }

        .blogs-hero__breadcrumb a {
            color: #fff;
            text-decoration: none;
        }

        .blogs-hero__breadcrumb a:hover {
            text-decoration: underline;
        }

        @media (max-width: 575.98px) {
            .blogs-hero {
                padding: 125px 0 64px;
            }

            .blogs-hero__description {
                font-size: 15px;
            }

            .blogs-hero__actions {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
            }
        }
    </style>
@endsection
@section('content')
    {{-- @dd($blogs) --}}
    <section class="blogs-hero">
        <div class="container">
            <div class="blogs-hero__eyebrow">
                <i class="ti-pencil" aria-hidden="true"></i>
                Ideas worth sharing
            </div>
            <h1 class="blogs-hero__title">Ideas and insights to keep you learning.</h1>
            <p class="blogs-hero__description">
                Explore stories, practical advice, and fresh perspectives from the Eduleb learning community.
            </p>
            <div class="blogs-hero__actions">
                <a class="blogs-hero__button" href="#blog-list">
                    Explore articles <i class="ti-arrow-down" aria-hidden="true"></i>
                </a>
                @auth
                    <button class="blogs-hero__button blogs-hero__button--secondary" type="button"
                        data-open-blog-post-modal>
                        <i class="ti-plus" aria-hidden="true"></i> Add a post
                    </button>
                @endauth
                <span class="blogs-hero__count">
                    <strong>{{ $blogs->count() }}</strong>
                    {{ $blogs->count() === 1 ? 'article' : 'articles' }} to explore
                </span>
            </div>
            <nav class="blogs-hero__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true"> / </span>
                <span aria-current="page">Blog</span>
            </nav>
        </div>
    </section>

    <!-- START BLOG -->
    <section id="blog-list" class="blog_area section-padding">
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
    @auth
    {{-- @dd($availableTags) --}}


        {{-- @php($availableTags = $blogs->flatMap(fn ($blog) => $blog->tags)->unique('id')->values()) --}}
        <div id="blog-post-modal" class="blog-post-modal" role="presentation"
            data-open-on-load="@if ($errors->hasAny(['title', 'sub_title', 'subject', 'image', 'content', 'tags'])) true @else false @endif"
            hidden>
            <section class="blog-post-modal__panel" role="dialog" aria-modal="true"
                aria-labelledby="blog-post-modal-title">
                <header class="blog-post-modal__header">
                    <div>
                        <p class="blog-post-modal__eyebrow">Share with the community</p>
                        <h2 class="blog-post-modal__title" id="blog-post-modal-title">Create a blog post</h2>
                    </div>
                    <button class="blog-post-modal__close" type="button" aria-label="Close dialog"
                        data-close-blog-post-modal>&times;</button>
                </header>

                <form class="blog-post-modal__form" method="POST" enctype="multipart/form-data" action="{{ route('student.applications.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="add_post">
                    <div class="blog-post-modal__grid">
                        <div class="blog-post-modal__field blog-post-modal__field--full">
                            <label class="blog-post-modal__label" for="blog-post-title">Post title</label>
                            <input class="blog-post-modal__input" id="blog-post-title" name="title" type="text"
                                value="{{ old('title') }}" placeholder="Give your post a clear title" required
                                data-modal-initial-focus>
                            @error('title')
                                <p class="blog-post-modal__error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="blog-post-modal__field">
                            <label class="blog-post-modal__label" for="blog-post-subtitle">Subtitle</label>
                            <input class="blog-post-modal__input" id="blog-post-subtitle" name="sub_title" type="text"
                                value="{{ old('sub_title') }}" placeholder="A short summary" required>
                            @error('sub_title')
                                <p class="blog-post-modal__error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="blog-post-modal__field">
                            <label class="blog-post-modal__label" for="blog-post-subject">Subject</label>
                            <input class="blog-post-modal__input" id="blog-post-subject" name="subject" type="text"
                                value="{{ old('subject') }}" placeholder="e.g. Learning, design" required>
                            @error('subject')
                                <p class="blog-post-modal__error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="blog-post-modal__field blog-post-modal__field--full">
                            <label class="blog-post-modal__label" for="blog-post-image">Cover image</label>
                            <input class="blog-post-modal__input" id="blog-post-image" name="image" type="file"
                                accept="image/jpeg,image/png,image/webp" required>
                            <p class="blog-post-modal__help">JPG, PNG, or WebP, up to 5 MB.</p>
                            @error('image')
                                <p class="blog-post-modal__error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="blog-post-modal__field blog-post-modal__field--full">
                            <label class="blog-post-modal__label" for="blog-post-content">Content</label>
                            <textarea class="blog-post-modal__textarea" id="blog-post-content" name="content" rows="6"
                                placeholder="Write your post..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <p class="blog-post-modal__error">{{ $message }}</p>
                            @enderror
                        </div>
                        @if ($availableTags->isNotEmpty())
                            <fieldset class="blog-post-modal__field blog-post-modal__field--full blog-post-modal__tag-group">
                                <legend class="blog-post-modal__label">Related tags</legend>
                                <div class="blog-post-modal__tags">
                                    @foreach ($availableTags as $tag)
                                        <label class="blog-post-modal__tag" for="blog-post-tag-{{ $tag->id }}">
                                            <input id="blog-post-tag-{{ $tag->id }}" name="tags[]" type="checkbox"
                                                value="{{ $tag->id }}"
                                                @checked(in_array($tag->id, old('tags', [])))>
                                            {{ $tag->name }}
                                        </label>
                                    @endforeach
                                </div>
                                @error('tags')
                                    <p class="blog-post-modal__error">{{ $message }}</p>
                                @enderror
                            </fieldset>
                        @endif
                    </div>

                    <footer class="blog-post-modal__footer">
                        <button class="blog-post-modal__cancel" type="button" data-close-blog-post-modal>Cancel</button>
                        <button class="blog-post-modal__submit" type="submit">Publish post</button>
                    </footer>
                </form>
            </section>
        </div>
    @endauth
@endsection()

@section('JS')
    @auth


        <script>
            (() => {
                const modal = document.getElementById('blog-post-modal');
                const openButton = document.querySelector('[data-open-blog-post-modal]');

                if (!modal || !openButton) {
                    return;
                }

                const closeButtons = modal.querySelectorAll('[data-close-blog-post-modal]');
                const closeModal = () => {
                    modal.hidden = true;
                    document.body.classList.remove('blog-post-modal-open');
                    openButton.focus();
                };
                const openModal = () => {
                    modal.hidden = false;
                    document.body.classList.add('blog-post-modal-open');
                    modal.querySelector('[data-modal-initial-focus]').focus();
                };

                openButton.addEventListener('click', openModal);
                closeButtons.forEach((button) => button.addEventListener('click', closeModal));
                modal.addEventListener('click', (event) => {
                    if (event.target === modal) {
                        closeModal();
                    }
                });
                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape' && !modal.hidden) {
                        closeModal();
                    }
                });

                if (modal.dataset.openOnLoad === 'true') {
                    openModal();
                }
            })();
        </script>
    @endauth
@endsection
