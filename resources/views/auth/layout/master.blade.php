<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Админка: @yield('title')</title>

    <!-- Scripts -->
    <script src="/js/app.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">
    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">--}}

</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{route('index')}}">
                Вернуться на сайт
            </a>

            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    @admin
                    <a class="navbar-brand" style="color: #6574cd;" href="{{ url('/admin/categories') }}">
                        Категории
                    </a>
                    <a class="navbar-brand" style="color: purple;" href="{{ route('products.index')}}">
                        Продукты
                    </a>

                    <a class="navbar-brand" style="color: #00b0e8;" href="{{ route('home') }}">
                        Заказы
                    </a>
                    @endadmin
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('get-logout')}}">Выйти</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session()->has('success'))
                                <p class="alert alert-success">{{session()->get('success')}} </p>
                            @endif
                            @if(session()->has('warning'))
                                <p class="alert alert-warning">{{session()->get('warning')}} </p>
                            @endif
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
