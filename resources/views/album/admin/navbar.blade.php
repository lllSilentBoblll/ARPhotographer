
<div class="container px-lg-5">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="{{ route('home') }}">Главная</a>
        <a class="navbar-brand {{ Request::is('adminIndex') ? 'active' : '' }}" href="{{ route('adminIndex') }}">Админ панель</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('adminAlbumsIndex') ? 'active' : '' }}">
                    <a class="nav-link "
                       href="{{ route('adminAlbumsIndex') }}">Альбомы <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ Request::is('adminPostIndex') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('adminPostIndex')}}">Блог</a>
                </li>
                <li class="nav-item {{ Request::is('adminCategoryIndex') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('adminCategoryIndex') }}">Категории</a>
                </li>

            </ul>
        </div>
    </nav>
</div>
