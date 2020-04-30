<!DOCTYPE html>
<html class="no-js"  lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('album/images/favicon.ico') }}" type="image/x-icon">
    <title>Photographer ///</title>
    <!-- Normalize -->
    <link rel="stylesheet" href="{{ asset('album/css/assets/normalize.css') }}" type="text/css">
    <!-- Bootstrap -->
    <link href="{{ asset('album/css/assets/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font-awesome.min -->
    <link href="{{ asset('album/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Effet -->
    <link rel="stylesheet" href="{{ asset('album/css/gallery/foundation.min.css') }}"  type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('album/css/gallery/set1.css') }}" />
    <!-- Main Style -->

    <link rel="stylesheet" href="{{ asset('album/css/main.css') }}" type="text/css">
    <!-- Responsive Style -->
    <link href="{{ asset('album/css/responsive.css') }}" rel="stylesheet" type="text/css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->




    <link rel="stylesheet" type="text/css" href="{{ asset('album/css/gallery/paginationStyle.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <!-- Pagination style-->



    <!--[if lt IE 9]>



    <![endif]-->

</head>

<body>

<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '223602768897035',
            cookie     : true,
            xfbml      : true,
            version    : 'v6.0'
        });

        FB.AppEvents.logPageView();

    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v6.0&appId=223602768897035&autoLogAppEvents=1">
</script>

<!-- header + menu -->
@yield('header')
<!-- header + menu-->


<!-- Photos Gallery -->
@yield('photosGallery')
<!-- Photos Gallery -->


<!-- Album Gallery -->
@yield('albumsGallery')
<!-- Album Gallery -->


<!-- Album Content -->
@yield('albumContent')
<!-- Album Content -->


{{--blog index--}}
@yield('blogIndexContent')
{{--blog index--}}


<!-- footer -->
@yield('footer')
<!-- footer -->


<!-- jQuery -->
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="{{ asset('album/js/assets/modernizr-2.8.3.min.js') }}" type="text/javascript"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script src="https://use.typekit.net/tqi0rfb.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="http://localhost:8000/album/js/assets/jquery.min.js"><\/script>')</script>
<script src="{{ asset('album/js/assets/plugins.js') }}" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="{{ asset('album/js/assets/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

<script src="{{ asset('album/js/custom.js') }}" type="text/javascript"></script>
<script src="{{ asset('album/js/jquery.contact.js') }}" type="text/javascript"></script>
<script src="{{ asset('album/js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('album/js/gallery/masonry.pkgd.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('album/js/gallery/imagesloaded.pkgd.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('album/js/gallery/jquery.infinitescroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('album/js/gallery/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('album/js/jquery.nicescroll.min.js') }}" type="text/javascript"></script>


<script src="http://localhost:8000/album/js/jquery.nicescroll.min.js" type="text/javascript"></script>

</body>
</html>

