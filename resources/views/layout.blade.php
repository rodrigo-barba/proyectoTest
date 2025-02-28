<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Layout del sistema</title>
</head>
<body>
    <header>
        Header
    </header>

    @yield('content')
    
    <section>
        @yield('moreContent')
    </section>
</body>
</html>