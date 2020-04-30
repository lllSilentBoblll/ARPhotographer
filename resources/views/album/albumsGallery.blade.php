{{--{{ dd($albums) }}--}}
@if( isset($albums) && count($albums) > 0)

    <main class="main-wrapper" id="container">
        <div class="wrapper">
            <div class="">
                <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-3 masonry">


                    @foreach($albums as $album)

                        <li class="masonry-item grid">
                            <figure class="effect-sarah"> <img
                                src="{{ isset($album->album_img) ? asset('https://res.cloudinary.com/gallerystorage9oi8/image/upload/v1582564847/'. $album->album_img)
                                                                 : asset('album/images/cover.jpg')}}"/>
                                <figcaption>
                                    <h2> <span>{{ $album->title }}</span></h2>
                                    <p>{{ Str::limit($album->description, 50)  }}</p>
                                    <p>{{ $album->category->title }}</p>
                                    <a href="{{ route('albums.show', $album->id) }}">View more</a>
                                </figcaption>
                            </figure>
                        </li>

                    @endforeach


                </ul>
                {{ $albums->links() }}
            </div>
        </div>
    </main>
@else
    <p> Галерея пуста </p>
@endif
