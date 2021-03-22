<!doctype html>
<html lang="en">
 <head>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- CoreUI CSS -->
 <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">

 <title>{{ config('app.name', 'Laravel') }}</title>
 <script src="{{ asset('js/app.js') }}" defer></script>
 </head>
 <body class="c-app">

    @include('partials.menu')
    <div class="c-wrapper c-fixed-components">
        <header class="c-header c-header-light c-header-fixed c-header-with-subheader">

        </header>
        <div class="c-body" id="app">
        <main class="c-main">
        <div class="container-fluid">
            <div >
                 @yield('content')
            </div>
        </div>
        </main>
        <footer class="c-footer">
        <div><a href="">Solutech Limited</a> © 2021 Labs.</div>
        <div class="ml-auto">Powered by&nbsp;<a href="">Solutech Limited</a></div>
        </footer>
        </div>
        </div>

 <!-- Optional JavaScript -->
 <!-- Popper.js first, then CoreUI JS -->
 <script src="https://unpkg.com/@popperjs/core@2"></script>
 <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
 </body>
</html>


