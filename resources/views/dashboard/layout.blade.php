<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <header>
        Header del layout Dashboard
    </header>

    {{-- para ejemplo session --}}
    {{-- @session('key2')
        {{ $value }}
    @endsession --}}

    {{-- muestra el mensaje, si esta seteado --}}
    @session('status')
        {{ $value }}
    @endsession

    @yield('content')
    
    <section>
        @yield('moreContent')
    </section>
</body>
</html>