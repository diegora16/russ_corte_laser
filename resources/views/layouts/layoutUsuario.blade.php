<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('fontawesome-free-6.6.0-web/css/all.min.css')}}">
  @vite('resources/css/app.css')
</head>
<body class="bg-cover bg-center bg-fixed" style="background-image: url('/img/fondo/fondo.jpg');">
    @include('header.headerUsuario')

    <div class="container mx-auto mt-10 md:mb-40 bg-white bg-opacity-75 p-5 rounded-lg">
      @yield('content')
    </div>
    
    @include('footer.footerUsuario')
</body>
</html>
