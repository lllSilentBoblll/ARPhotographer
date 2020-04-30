@extends('album.layouts.site')

@section('navbar')
    @include('album.admin.navbar')

    <div class="container">
        <div class="d-flex flex-column">

            <form action="{{ ($post->exists) ? route('adminPostUpdate', ['post' => $post->id]) : route('adminPostStore')  }}"
                  method="post" enctype="multipart/form-data">
                {{ ($post->exists) ? method_field('PATCH') : '' }}
                @csrf

                {{--Отображение ошибок--}}
                {{--                    @php /** @var \Illuminate\Support\ViewErrorBag $errors @endphp--}}
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach($errors as $error)
                                <li>{{ $error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{--Отображение ошибок--}}

                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="Input1" style="color: #ffffff">Название поста</label>
                    <input name="title" type="text" class="form-control" id="Input1"
                           value="{{ old('title', $post->title) }}" required>
                </div>


                <div class="form-group">
                    <label for="Input2" style="color: #ffffff">Описание</label>
                    <textarea name="description"  type="text" class="form-control" id="Input2" rows="4">
                    {{old('description', $post->description)}} </textarea>
                </div>

                {{-- Загрузка фотографий--}}
                {{--            vue files upload--}}
                {{--            <div>--}}
                {{--                <photo-upload></photo-upload>--}}
                {{--            </div>--}}
                {{--            vue files upload--}}

                <div class="form-group">
                    <label for="LoadPhotos" style="color: #ffffff">Загрузить фотографии</label>
                    <input style="color: #ffffff" name="photos[]" type="file" multiple class="form-control-file" id="LoadPhotos" value="albumImg">
                </div>

                {{-- Загрузка фотографий--}}

                <button class="btn btn-primary" type="submit">{{isset($album->id) ? 'Сохранить изменения' : 'Создать альбом'}}</button>


            </form>
        </div>



        {{--  Кнопка удаления альбома  --}}
        @if($album->exists)
            <form method="post" action="{{route('adminPostDestroy', $post->id)}}">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">Удалить пост</button>
            </form>
        @endif
    </div>


@endsection
