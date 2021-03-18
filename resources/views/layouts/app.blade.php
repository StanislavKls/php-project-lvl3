
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Анализатор страниц - @yield('title')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/starter-template/">
  

    <!-- Bootstrap core CSS -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Favicons -->
    <meta name="theme-color" content="#7952b3">
    <!-- Custom styles for this template -->
    <link href="/css/starter.css" rel="stylesheet">
  </head>

  <body class="min-vh-100 d-flex flex-column">
    @include('layouts.nav')

    <main class="flex-grow-1">
      @yield('content')
    </main>

  </body>
  
</html>
