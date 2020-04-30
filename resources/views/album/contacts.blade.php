@extends('album.layouts.site')

@section('header')
    @include('album.header')

        <!-- main-wrapper-inner -->
        	<main class="main-wrapper-inner" id="container">
            	<div class="container">
                    <div class="wrapper-inner">
                    	<!-- map -->
{{--                        <div class="map-wrapper">--}}
{{--                            <div id="surabaya"></div>--}}
{{--                        </div>--}}
                        <div class="map-responsive">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1259.2439525481334!2d24.02721743388927!3d49.84787998046314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sua!4v1567096712530!5m2!1sru!2sua" width="1000" height="500" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        </div>
                        <!-- map -->
                        <!-- contact -->
                        <div class="contact-wrapper">
                        	<!-- left -->
                        	<div class="inner-left">
                            	<p class="phone"><a href="tel:8197654321">+8197654321</a></p>
                            	<p class="email"><a href="mailto:contact@Picxa.com">contact@Picxa.com</a></p>
                            </div>
                            <!-- left -->

                            <!-- right -->
                            <div class="inner-right">
                            	<header>
                                	<h4>Feel Free to Contact Me</h4>
                                </header>

                                <!-- contact-form -->
                                <div class="contact-form">
                                    <div id="message"></div>

                                    <form method="post" action="php/contactfrom.php" name="cform" id="cform">

                                    	<label>Whats your name <span>*</span>
                                        	<input  name="name" id="name" type="text">
                                        </label>

                                        <label>Whats your email <span>*</span>
                                        	<input  name="email" id="email" type="email">
                                        </label>

                                        <div class="clearfix"></div>

                                        <label>Whats in your mind
                                        	<textarea name="comments" id="comments" cols="" rows=""></textarea>
                                        </label>

                                        <div class="clearfix"></div>
                                            <input name="" type="submit" value="Send Mail">
                                    	<div id="simple-msg"></div>

                                    </form>

                                </div>
                                <!-- contact-form -->
                            </div>
                            <!-- right -->
                        </div>
                        <!-- contact -->
                    </div>
                </div>
            </main>
          <!-- main-wrapper-inner -->

{{--    <div class="map-responsive">--}}
{{--        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1259.2439525481334!2d24.02721743388927!3d49.84787998046314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sua!4v1567096324140!5m2!1sru!2sua" width="800" height="600" frameborder="0" style="border:0;" allowfullscreen=""></iframe>--}}
{{--    </div>--}}
{{--        <script src="{{ asset('album/js/maps.js') }}" type="text/javascript"></script>--}}

    @include('album.footer')
@endsection
