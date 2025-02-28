<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hello world</title>
</head>
<body>
    <h1>hello word</h1>   
    <h3>
        <!-- <?php echo $nombre ?> 
            las llaves dobles es el equivalente en Blade 
         -->
        {{ $nombre }} 
    </h3>
    <h4>{{ $edad }}</h4>  
    <!-- <a href="/test">ir a pagina test</a> -->
    <a href="{{ route('rutaTest') }}">ir a pagina test</a>
</body>
</html>