<?php use App\Album; /** @var Album $album */ ?>
<div class="container">
{{--<div class="container row">--}}
{{--    <div class="d-flex flex-column col-lg-8">--}}
{{--    {{dd($album->exists)}}--}}
    <form action="{{($album->exists ) ? route('adminAlbumUpdate', ['album' => $album->id]) : route('adminAlbumStore')}}"
          method="post" enctype="multipart/form-data">
        {{ ($album->exists) ? method_field('PATCH') : '' }}
        @csrf
        {{--Отображение ошибок--}}
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{--Отображение ошибок--}}

        @if(session('success'))                     {{--Session::has('success')--}}
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}    {{--Session::get('success')--}}
            </div>
        @endif
    <div class="container row justify-content-center">
        <div class="d-flex flex-column col-lg-8">
            <div class="form-group">
                <label for="Input1" style="color: #ffffff">Название альбома</label>
                <input name="title" type="text" class="form-control {{ $errors->get('title') ? "is-invalid" : "" }}" id="Input1"
                       value="{{ old('title', $album->title) }}" required>
            </div>

            <div class="form-group">
                <label for="Input3" style="color: #ffffff">Заказчик</label>
                <input name="customer" type="text" class="form-control" id="Input3"
                value="{{ old('customer', $album->customer) }}" >
            </div>

            <div class="form-group">
                <label for="Input4 " style="color: #ffffff">Модели</label>
                <input name="model" type="text" class="form-control" id="Input4"
                       value="{{ old('model', $album->model) }}" >
            </div>

            <div class="form-group">
                <label for="Input5" style="color: #ffffff">Камера</label>
                <input name="camera" type="text" class="form-control" id="Input5"
                       value="{{ old('camera', $album->camera) }}" >
            </div>

            <div class="form-group">
                <label for="Select1" style="color: #ffffff">Категория</label>
                <select name="category_id" class="form-control" id="Select1" required>
                    @foreach($categories as $categoryOption)
                        <option @if($album->exists && $album->category->id == $categoryOption->id)
                                selected="selected" @endif
                                value="{{$categoryOption->id}}">
                            {{$categoryOption->title}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="Input2" style="color: #ffffff">Описание</label>
                <textarea name="description"  type="text" class="form-control" id="Input2"
                          rows="4">{{old('description', $album->description)}}</textarea>
            </div>


        {{-- Загрузка фотографий--}}
            <div class="form-group">
                <label for="LoadPhotos" style="color: #ffffff">Загрузить фотографии (макс. 10шт за раз)</label>
                <input style="color: #ffffff" name="photos[]" type="file" multiple class="form-control-file"
                       id="LoadPhotos" value="albumImg">
            </div>
        {{-- Загрузка фотографий--}}

            {{--Кнопка отправки формы--}}
            <div>
                <button class="btn btn-primary" type="submit">
                    {{($album->exists) ? 'Сохранить изменения' : 'Создать альбом'}}
                </button>
            </div>
            {{--Кнопка отправки формы--}}
{{--        </form>--}}
        </div>


        <div class="col-lg-4">
            <label for="cover" style="color: #ffffff" >Обложка альбома</label>

                <div id="cover" class="card" style="width: 100%;">
                    <img alt="Обложка альбома" class="card-img-top"
                         src="{{ isset($album->album_img) ?
                         asset('https://res.cloudinary.com/gallerystorage9oi8/image/upload/v1582564847/'
                         . $album->album_img) : asset('album/images/cover.jpg')}}">
                </div>

            {{-- Загрузка обложки альбома--}}
            <div class="form-group">
                <label for="LoadCover" style="color: #ffffff">Загрузить обложку альбома</label>
                <input style="color: #ffffff" name="album_img" type="file" multiple class="form-control-file"
                       id="LoadCover" value="albumImg">
            </div>
            {{-- Загрузка обложки альбома--}}
        </div>

    </div>
</form>

    {{--  Кнопка удаления альбома  --}}
    @if($album->exists)
        <form method="post" action="{{route('adminAlbumDestroy', $album->id)}}">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">Удалить альбом</button>
        </form>
    @endif
    {{--  Кнопка удаления альбома  --}}
</div>

<div>
    {{--  Фото с чекбоксами для выборки под удаление --}}

    @if($album->photos->count() > 0)
    <div class="container-fluid m-3">
        <div class="container">
            <div class="card-columns" style="column-count: 4;">

                    <form method="post" action="{{ route('adminAlbumUpdate', ['album' => $album->id]) }}">
                        @method('PATCH')
                        @csrf

                        <input name="title" type="hidden" class="form-control" value="{{ old('title', $album->title) }}">
                        <input name="category_id" type="hidden" class="form-control" value="{{ $album->category->id }}" >

                        @foreach($album->photos as $photo)
                            <div class="card" style="width: 100%;">
                                <img class="card-img-top"
                            src="{{ asset('https://res.cloudinary.com/gallerystorage9oi8/image/upload/v1585794728/'
                            . $photo->imgName)}}">
                                <div class="card-img-overlay custom-control custom-checkbox"
                                     style="height: 20px; width: 20px;">
                                    <input  type="checkbox"  name="photosToDelete[]" value="{{$photo->id}}">
                                </div>
                            </div>
                        @endforeach

                        <button class="btn badge-light" type="submit">Удалить выбранные фотографии</button>
                    </form>

            </div>
        </div>
    </div>
    @endif
    {{--  Фото с чекбоксами для выборки под удаление --}}


</div>






