@extends('layouts.website')
@section('title', 'Eduleb - FAQ ')
@section('content')
    <!-- START SECTION TOP -->
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <h1>Faq</h1>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li> / Faq</li>
                    </ul>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->

    <!-- START FAQ -->
    <section class="faq_area section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-sm-12 col-xs-12">
                    <div class="accordion" id="accordionExample">
                        @forelse ($faqs as $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse " aria-labelledby="heading{{ $faq->id }}"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div><!-- END ACCORDION ITEM  -->

                        @empty
                            <div style="font-size:30px; margin: 400px auto" class="col-12 font-semibold text-center">No FAQ Yet!</div>
                        @endforelse
                    </div>
                </div><!-- END COL  -->
                <div class="col-lg-5 col-sm-12 col-xs-12">
                    <div class="faq_img">
                        <img src="{{ asset('assets/img/faq.jpg') }}" alt="faq image" />
                    </div>
                </div>

            </div><!--END  ROW  -->
        </div><!--- END CONTAINER -->
        <div>{{ $faqs->links() }}</div>
    </section>
    <!-- END FAQ -->
@endsection()
