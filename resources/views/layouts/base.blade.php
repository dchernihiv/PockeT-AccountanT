<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PockeT AccountanT')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/app.css']) 
</head>

<body>

    <div class="page d-flex flex-column">
        @yield('header')
       
        <main style="flex-grow: 1;">
            <article>
                @yield('content')
            </article>
        </main>
 
        @yield('footer')
    </div>
    
    @vite(['resources/js/app.js'])
</body>

</html>