<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

</head>

<body>

    <!-- header -->
    <header>
        <nav>
            <a href="/login">Login</a>
        </nav>
    </header>
    <!-- end header -->

    <main>
        @yield('content')
    </main>

    <!-- footer -->
    <footer>
        <h1>Footer</h1>
    </footer>
    <!-- end footer -->

</body>

</html>
