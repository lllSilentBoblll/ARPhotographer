@extends ('album.layouts.admin')

<!-- admin menu -->
@section('navbar')
    @include('album.admin.navbar')
@endsection
<!-- admin menu -->

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        <a class="btn btn-primary" href="{{ route('adminCategoryCreate') }}">Создать категорию</a>
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}} </th>

                    <td>
                        {{$category->title}}
                    </td>

                    <td>
                        <a class="btn-default" href="{{route('adminCategoryEdit', $category->id)}}">Редактировать</a>
                    </td>
                    <td>
                        <form method="post" action="{{route('adminCategoryDelete', $category->id)}}">
                            @csrf
                            @method('delete')
                            <button type="submit">Удалить</button>
                        </form>
                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection()
