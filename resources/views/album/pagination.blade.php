@if($photos->lastPage() > 1)
    <div class="pagination__wrapper">
        <ul class="pagination">

            @if($photos->currentPage() !== 1)
                <li>
                    <a class="prev" href="{{ $photos->url($photos->currentPage() - 1) }}" > &#10094;</a>
                </li>
            @endif

                <li>
                    <a href="{{ $photos->url(1) }}" class="{{ ($photos->currentPage() == 1) ? 'active disabled' :''}}" >1</a>
                </li>


                @if($photos->currentPage() > 4)
                    <li>
                        <span>...</span>
                    </li>
                @endif

            @for($i = 2, $j = 0; $i < $photos->lastPage(); $i++, $j++)



                <li>
                     <a  href="{{ $photos->url( $i ) }}" class="{{ ( $i == $photos->currentPage()) ? 'active' : ''  }}">{{ $i }}</a>
                </li>
{{--                @if($j = 3)--}}
{{--                    @break--}}
{{--                @endif--}}

            @endfor

                @if($photos->currentPage() < $photos->lastPage() - 3 )
                    <li>
                        <span>...</span>
                    </li>
                @endif


                <li>
                    <a href="{{ $photos->url($photos->lastPage()) }}">{{ $photos->lastPage() }}</a>
                </li>

                @if($photos->currentPage() !== $photos->lastPage())

                    <li>
                        <a class="next" title="next page">&#10095;</a>
                    </li>

                @endif

        </ul>
    </div>
@endif
