<!-- main-wrapper-inner -->
<main class="main-wrapper-inner blog-wrapper" id="container">
    <div class="container">
        <div class="wrapper-inner">

        @if(count($album->photos) > 0)

            @foreach($album->photos as $key => $photo)

                @if($key === 0)

                    <!-- details-image -->
                        <figure class="details-image">
                            <img alt="Обложка" src="{{ asset('https://res.cloudinary.com/gallerystorage9oi8/image/upload/v1582564847/'.$photo->imgName) }}" class="img-responsive"/>
                        </figure>
                        <!-- details-image -->

                        <!-- content -->
                        <div class="details-content">
                            <!-- left -->
                            <section class="inner-left">
                                <span class="date">{{$photo->created_at}}</span>
                                <header>
                                    <h3>Заказчик: {{ $album->customer }}</h3>
                                    <h4>Модели: {{ $album->model }}</h4>
                                    <h5>Фотограф: {{--}}{{ user->name... }}--}} </h5>
                                </header>
                            </section>
                            <!-- left -->

                            <!-- right -->
                            <section class="inner-right">
                                <p>{{ $album->descriptiom }}</p>
                                <header>
                                    <h2>Использовалась камера:</h2>
                                    <h3>{{ $album->camera }}</h3>
                                </header>
                            </section>
                            <div class="clearfix"></div>
                            <!-- right -->
                        </div>
                    @continue
                    @endif

                    <figure class="details-image">
                        <img src="{{  asset('https://res.cloudinary.com/gallerystorage9oi8/image/upload/v1582564847/'.$photo->imgName) }}"
                             class="img-responsive"/>
                    </figure>

            @endforeach
        @else Альбом пуст
        @endif


        </div>
    </div>
</main>
<!-- main-wrapper-inner -->
