<!doctype html>
<html lang="cs">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @if (env('APP_ENV')!='production')
    <script src="http://localhost:8098"></script>
    @endif
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>Tankovna Modrá Kočka</title>
</head>
<body>
@yield('topMenu')
@yield('bottomMenu')
@yield('content')
@yield('scripts')
</body>
</html>
