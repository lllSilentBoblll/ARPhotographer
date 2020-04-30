
<header id="header" class="header">
    <div class="container-fluid">
        <hgroup>
            <!-- logo -->
            <h1> <a href="{{ route('home') }}" title="Picxa">
                    <img src="{{ asset('album/images/logo1.jpg') }}" alt="Picxa" title="Picxa"/></a> </h1>
            <!-- logo -->

            <!-- nav -->
            <nav>
                <div class="menu-expanded">
                    <div class="nav-icon">
                        <div id="menu" class="menu"></div>
                        <p>Меню</p>
                    </div>
                        <div class="cross">
                            <span class="linee linea1"></span>
                            <span class="linee linea2"></span>
                            <span class="linee linea3"></span>
                        </div>
                    <div class="main-menu">
                        <ul>
                            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">Главная</a></li>
                            <li class="{{ Request::is('albums') ? 'active' : '' }}"><a href="{{ route('albums.index') }}">Альбомы</a></li>
                            <li class="{{ Request::is('posts') ? 'active' : '' }}"><a href="{{route('posts.index')}}">Блог</a></li>
                            <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="{{route('about')}}">Информация о фотографе</a></li>
                            <li class="{{ Request::is('contacts') ? 'active' : '' }}"><a href="{{route('contacts')}}">Контакты</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- nav -->
        </hgroup>
    </div>
</header>

