@extends ('album.layouts.admin')

<!-- admin menu -->
@section('navbar')
    @include('album.admin.navbar')
@endsection
<!-- admin menu -->

@section('content')
    <div class="container">
        <form method="post" action="{{ ($category->exists) ? route('adminCategoryUpdate', ['category' => $category->id])
                                                            : route('adminCategoryStore')}}">
            {{ ($category->exists) ? method_field('PATCH') : '' }}
            @csrf
            <div class="form-group row">
                <label class="col-4 col-form-label" for="title">Название</label>
                <div class="col-8">
                    <input id="title" name="title" type="text" class="form-control
                    @if( $errors->has('title')) is-invalid @endif" required value="{{old('title', $category->title)}}">
                </div>
                @if($errors->has('title'))
                    <ul>
                        @foreach($errors->get('title') as $error)
                            <li> {{$error}}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-primary">
                        {{($category->exists) ? 'Сохранить изменения' : 'Создать категорию'}}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection()
