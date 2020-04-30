@if( isset($photos) && count($photos) > 0)

    <main class="main-wrapper" id="container">
        <div class="wrapper">
            <div>
                <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-3 masonry">

                    @foreach($photos as $photo)
                        <li class="masonry-item grid">
                            <figure class="effect-steve"> <img
src="{{ asset('https://res.cloudinary.com/gallerystorage9oi8/image/upload/v1582564847/'.$photo->imgName)}}" alt="" />
                            </figure>
                        </li>
                    @endforeach

                </ul>
                {{ $photos->links('album.pagination' , ['photos' => $photos]) }}
            </div>
        </div>
    </main>

@else
    <p> Галерея пуста </p>
@endif
