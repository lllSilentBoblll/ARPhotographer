{{--{{ dd($albums) }}--}}
<div class="container">
    @if( isset($albums) && count($albums) > 0)
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        <table class="table table-bordered justify-content-center">
            <thead>
            <tr>
                <th scope="col" style="color: #ffffff">Название</th>
                <th scope="col" style="color: #ffffff">Категория</th>
                <th scope="col" style="color: #ffffff">Описание</th>
                <th scope="col" style="color: #ffffff">Обложка</th>
                <th scope="col" style="color: #ffffff">Кол-во фотографий</th>
            </tr>
            </thead>
            <tbody>

            @foreach($albums as $album)
                <tr>
                    <th scope="row" style="color: #ffffff">
                        {{ $album->title }} <br>
                        <a class="btn btn-primary"
                           href="{{ route('adminAlbumEdit', $album->id) }}">Редактировать
                        </a>
                        <br>
                        {{--кнопка удаления--}}
                        <form method="post" action="{{route('adminAlbumDestroy', $album->id)}}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Удалить альбом</button>
                        </form>
                        {{--кнопка удаления--}}

                    </th>

                    <td style="color: #ffffff">
                        {{ $album->category->title }}
                    </td>

                    <td style="color: #ffffff">{{ Str::limit($album->description, 50) }}</td>

                    <td>
    {{--                    <img width="200px" height="200px" src="{{ asset('album/images/gallery/'.$album->albumImg)}}" --}}
    {{--                          class="rounded float-left" alt="..."> --}}
                        <img class="adminPanel"
                             src="{{ isset($album->album_img) ?
                         asset('https://res.cloudinary.com/gallerystorage9oi8/image/upload/v1582564847/'
                         . $album->album_img) : asset('album/images/cover.jpg')}}"/>
                    </td>

                    <td style="color: #ffffff">{{$album->photos_count}}</td>

                </tr>
            @endforeach

            </tbody>
        </table>
        {{ $albums->links() }} <!-- нафиг он тут нужен? \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
        @else
        Альбомов нет
    @endif
    <a href="{{route('adminAlbumCreate')}}" class="btn btn-info">Создать альбом</a>
</div>
