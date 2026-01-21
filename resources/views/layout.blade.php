<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Web Inventaris</title>
    <link rel="stylesheet" href="{{ asset('css/inventaris.css') }}">
</head>
<body>
<nav class="navbar">
    <div class="nav-brand">
        🗃️ Aplikasi Inventaris
    </div>

    <div class="nav-menu">
        <a href="/inventaris" class="nav-link">Inventaris</a>
        <a href="/users" class="nav-link">Manajemen User</a>
    </div>
</nav>

<hr>

@yield('content')
    
</body>
</html>