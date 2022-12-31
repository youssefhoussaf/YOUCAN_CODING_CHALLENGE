<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- **** BOOTSTRAP **** -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <!-- **** VUEJS 3 **** -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <!-- **** AXIOS **** -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- **** FONT AWESOME **** -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- **** Moment.js **** -->
    <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>

    <!-- **** Sweet alert **** -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <title> @yield('title')  </title>

</head>
<body>

    <div class="container">
        <header class="d-flex justify-content-center py-3">
          <ul class="nav nav-pills">
            <li class="nav-item"><a href="/" class="nav-link {{ Request::is('/')?'active':'' }}" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="/products" class="nav-link {{ Request::is('products')?'active':'' }}">Products</a></li>
            <li class="nav-item"><a href="/categories" class="nav-link {{ Request::is('categories')?'active':'' }}">Categories</a></li>
          </ul>
        </header>
      </div>

      <div class="col-lg-8 mx-auto p-4 py-md-5">
        @yield('main')
      </div>

</body>
</html>