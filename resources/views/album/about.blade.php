@extends('album.layouts.site')

@section('header')
    @include('album.header')
    <!-- main-wrapper-inner -->
    <main class="main-wrapper-inner" id="container">
        <div class="container">
            <div class="wrapper-inner">
                <!-- details-image -->
                <figure class="details-image">
                    <img style="width: 50%" src="{{asset('album/images/gallery/36.jpg')}}" alt="" class="img-responsive"/>
                </figure>
                <!-- details-image -->
                <!-- content -->
                <div class="about-content">
                    <!-- left -->
                    <section class="inner-left">
                        <header>
                            <h4>Алина Россошанская</h4>
                            <h5>Фотограф</h5>
                        </header>
                    </section>
                    <!-- left -->

                    <!-- right -->
                    <section class="inner-right">
                        <h3>Немного обо мне</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed volutpat eu nibh ultricies
                            semper. Vivamus porta, felis vitae facilisis sodales, felis est iaculis orci, et ornare
                            sem mauris ut turpis. Pellentesque vitae tortor nec tellus hendrerit aliquam. Donec
                            condimentum leo eu ull pellentesque urna rhoncus.</p>
                        <p>elis est iaculis orci, et ornare sem mauris ut turpis. Pellentesque vitae tortor nec
                            tellus hendrerit aliquam. Donec condimentum leo eu ullamcorper scelerisque pellentes
                            rhoncus.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed volutpat eu nibh
                            ultricies semper. Vivamus porta, felis vitae facilisis sodales, felis est iaculis orci,
                            et ornare sem mauris ut turpis. Pellentesque vitae tortor nec tellus hendrerit aliquam.
                            Donec condimentum leo eu ull pellentesque urna rhoncus.</p>
                        <p> elis est iaculis orci, et ornare sem mauris ut turpis. Pellentesque vitae tortor nec tellus hendrerit aliquam. Donec condimentum leo eu ullamcorper scelerisque pellentes rhoncus.</p>
                    </section>
                    <!-- right -->
                </div>
                <!-- content -->
            </div>
        </div>
    </main>
    <!-- main-wrapper-inner -->
    @include('album.footer')

@endsection
