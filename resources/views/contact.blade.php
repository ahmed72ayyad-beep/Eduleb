@extends('layouts.website')
@section('title', 'Eduleb - Contact Us ')
@section('content')
    <!-- START SECTION TOP -->
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <h1>Get In Touch</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li> / Contact</li>
                    </ul>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->

    <!-- START ADDRESS -->
    <section class="address_area section-padding">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.1s" data-wow-offset="0">
                    <div class="single_address sa_one">
                        <i class="ti-map"></i>
                        <h4>Our Location</h4>
                        <p style="font-size: 15px">3481 Melrose Place, Beverly Hills <br /> CA 90210</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.2s" data-wow-offset="0">
                    <div class="single_address sa_two">
                        <i class="ti-mobile"></i>
                        <h4>Telephone</h4>
                        <p style="font-size: 15px">(+1) 517 397 7100</p>
                        <p style="font-size: 15px">(+1) 411 315 8138</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.3s" data-wow-offset="0">
                    <div class="single_address sa_three">
                        <i class="ti-email"></i>
                        <h4>Send email</h4>
                        <p style="font-size: 15px">Info@example.com</p>
                        <p style="font-size: 15px">admin@example.com</p>
                    </div>
                </div><!-- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END ADDRESS -->

    <!-- CONTACT -->
    <div id="contact" class="contact_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0">
                    <div class="contact">
                        <form class="form" name="enq" method="POST" action="{{ route('contact') }}"
                            onsubmit="return validation();">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <x-input class="form-control" name="name" id="name" label="Your name" />
                                </div>
                                <div class="form-group col-md-6">
                                    <x-input class="form-control" type="email" name="email" id="email"
                                        label="Your Email" />
                                </div>
                                <div class="form-group col-md-12">
                                    <x-input class="form-control" name="subject" id="subject"
                                        label="Your subject" />
                                </div>


                                <div class="form-group col-md-12">
                                    <x-textarea label="Your Message" class="form-control" name="message" rows="6" />
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" value="Send message" name="submit" id="submitButton"
                                        class="btn_one" title="Submit Your Message!">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- END COL  -->
                <div class="col-lg-5 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0">
                    <div class="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.957183635167!2d-74.00402768559431!3d40.71895904512855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2598a1316e7a7%3A0x47bb20eb6074b3f0!2sNew%20Work%20City%20-%20(CLOSED)!5e0!3m2!1sbn!2sbd!4v1600305497356!5m2!1sbn!2sbd"
                            style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div><!-- END COL  -->
            </div><!-- END ROW -->
        </div><!--- END CONTAINER -->
    </div>
    <!-- END CONTACT -->
@endsection()
