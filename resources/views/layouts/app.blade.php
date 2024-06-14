<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Educate') }}</title>

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('img/logo/fevicon.png') }}" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap.min.css') }}" />
     <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">

    <!-- Toastr CSS -->    
    <link rel="stylesheet" href="{{ URL::asset('css/toastr.min.css') }}">

    <!-- Fonts cdn -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" defer />

    <link rel="stylesheet" href="{{ URL::asset('css/jquery.dataTables.min.css') }}">
     <!-- DataTables Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}" />
    @yield('page-style')
    </head>
    <body>
        <div id="app">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>

    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>

    <!-- Popper JS and Bootstrap JS -->
    <script src="{{ URL::asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ URL::asset('js/popper.min.js') }} "></script>
    <script src="{{ URL::asset('js/intlTelInput.min.js') }}"></script>
    <script src="{{ URL::asset('js/Chart.js') }}"></script>

    <script src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
     <!-- DataTables Bootstrap JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Toastr JS -->
    <script src="{{ URL::asset('js/toastr.min.js') }}"></script>
    
    <script src="{{ URL::asset('js/custom.js') }}"></script>
    @yield('page-script')
</html>